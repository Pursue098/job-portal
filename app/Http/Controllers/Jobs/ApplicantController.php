<?php

namespace App\Http\Controllers\Jobs;


use App\CVs;
use App\User;
use App\Job;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Helper\FillableDropdown;
use Carbon\Carbon;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *`
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $logged_user = $user->id;

            $user = User::findOrFail($logged_user);
            $jobsByUser = $user->jobs;

        } else{

            $logged_user = false;
        }

        $FillableDropdown = new FillableDropdown();
        $gender = $FillableDropdown->gender($default = 2);
        $travel = $FillableDropdown->travel($default = 2);

        $jobs = Job::orderBy('created_at', 'desc')
            ->where('active', 1)
            ->whereDate('last_date', '>=', Carbon::today())
            ->paginate(20);

        return view('jobs.job_listing_page', compact('jobs', 'gender', 'travel', 'logged_user', 'user', 'jobsByUser'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Load form for apply a job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getJob($id)
    {
        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        if(isset($user_id)){

            $user = User::findOrFail($user_id);
            if (count($user) > 0){

                $user_cvs = $user->cvs()->where('user_id', '=', $user_id)->pluck('name', 'id');

                if(isset($user_cvs)  && count($user_cvs) > 0){

                    $user_cvs = $user_cvs->prepend('Choose your cv…', '');
                }
            }
        }

        $job = Job::findOrFail($id);
        if (count($job) > 0){

            $job_user = $job->user()->wherePivot('user_id', '=', $user_id)->get();

            if(count($job_user) > 0) {

                return redirect()->back()->withErrors('You have already apply for this job.Thanx.');

            }
        }


        return view('jobs.apply_job', compact('job', 'user', 'user_cvs'));
    }


    /**
     * Apply for a job
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        if($request->has('job_id')){
            $job_id = $request->job_id;
        }

        $validator = Validator::make($request->all(), [
            'job_id'               => 'required|unique:job_user,job_id,NULL,,job_id,'.$job_id.',user_id,'.$user_id,
        ]);


        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);
        }


        if(empty($request->cv_id) && empty($request->cv_file) && empty($request->new_cv_file)){


            return redirect()->back()->withInput()->withErrors('Please choose a cv file. Thanx');
        }

        if(empty($request->cv_id) && !empty($request->new_cv_file)){

            if(empty($request->name)){

                return redirect()->back()->withInput()->withErrors('Please provide CV name. Thanx');
            }else{

                $name = $request->name;
                if(!empty($request->description)){

                    $description = $request->description;
                }
            }
        }

        if($request->has('cover_letter') && isset($request->cv_file) && isset($job_id) && isset($user_id)){

            $extension = $request->cv_file->extension();
            $cv_file_name = md5(uniqid() . microtime());
            $cv_file_name_ext = $cv_file_name.'.'.$extension;

            $file = $request->cv_file->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $filext = pathinfo($file, PATHINFO_EXTENSION);
            $filename_ext = $filename.'.'.$filext;

            Storage::put(config('paths.cv').$cv_file_name_ext, file_get_contents($request->cv_file));
            Storage::put(config('paths.applications').$cv_file_name_ext, file_get_contents($request->cv_file));

            if(isset($filename) && isset($cv_file_name_ext)){

                $FillableDropdown = new FillableDropdown();
                $status = $FillableDropdown->statusByKeyValue($default = 2);
                if (isset($status[0]['key'])){
                    $status = $status[0]['key'];
                }

                if(isset($job_id) && isset($status)){


                    $job = Job::findOrfail($job_id);
                    if(count($job) > 0){

                        if($job->user){

                            $data = [
                                'name'         => $filename_ext,
                                'file'         => $cv_file_name_ext,
                                'user_id'      => $user_id,
                                'active'       => 1,
                            ];


                            if ($data) {

                                $cv = CVs::create($data);
                            }

                            if(isset($cv) && count($cv) > 0){
                                $cv_id = $cv->id;

                                if(isset($cv_id)){

                                    $job->user()->attach($user_id, [
                                        'cover_letter' => $request->cover_letter,
                                        'cv_id'        => $cv_id,
                                        'status'       => $status,
                                        'active'       => 1
                                    ]);
                                }
                            }

                            return redirect()->back()
                                ->withSuccess('Your have applied Successfully.');
                        }
                    }
                }else{

                    return redirect()->back()
                        ->withErrors('Operation failed. Please try again.');
                }
            }else{

                return redirect()->back()
                    ->withErrors('Operation failed. Please try again.');
            }


        }
        elseif($request->has('cover_letter') && isset($request->new_cv_file) && isset($job_id) && isset($user_id)){

            $extension = $request->new_cv_file->extension();
            $cv_file_name = md5(uniqid() . microtime());
            $cv_file_name_ext = $cv_file_name.'.'.$extension;

            $file = $request->new_cv_file->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $filext = pathinfo($file, PATHINFO_EXTENSION);
            $filename_ext = $filename.'.'.$filext;

            if(!empty($name)){

                $cv_name = $name.'.'.$extension;
            }else{

                $cv_name = $filename_ext;
            }
            if(!isset($description)){

                $cv_description = null;
            }else{

                $cv_description = $description;
            }

            Storage::put(config('paths.cv').$cv_file_name_ext, file_get_contents($request->new_cv_file));
            Storage::put(config('paths.applications').$cv_file_name_ext, file_get_contents($request->new_cv_file));

            if(isset($cv_name) && isset($cv_file_name_ext)){

                $FillableDropdown = new FillableDropdown();
                $status = $FillableDropdown->statusByKeyValue($default = 2);
                if (isset($status[0]['key'])){
                    $status = $status[0]['key'];
                }

                if(isset($job_id) && isset($status)){


                    $job = Job::findOrfail($job_id);
                    if(count($job) > 0){

                        if($job->user){

                            $data = [
                                'name'         => $cv_name,
                                'description'  => $cv_description,
                                'file'         => $cv_file_name_ext,
                                'user_id'      => $user_id,
                                'active'       => 1

                            ];

                            if ($data) {

                                $cv = CVs::create($data);
                            }

                            if(isset($cv) && count($cv) > 0){
                                $cv_id = $cv->id;

                                if(isset($cv_id)){

                                    $job->user()->attach($user_id, [
                                        'cover_letter' => $request->cover_letter,
                                        'cv_id'        => $cv_id,
                                        'status'       => $status,
                                         'active'       => 1

                                    ]);
                                }
                            }

                            return redirect()->back()
                                ->withSuccess('Your have applied Successfully.');
                        }
                    }
                }else{

                    return redirect()->back()
                        ->withErrors('Operation failed. Please try again.');
                }
            }else{

                return redirect()->back()
                    ->withErrors('Operation failed. Please try again.');
            }


        }
        elseif($request->has('cv_id') && $request->has('cover_letter') && isset($request->cv_id)){

            $FillableDropdown = new FillableDropdown();
            $status = $FillableDropdown->statusByKeyValue($default = 2);

            if (isset($status[0]['key'])){
                $status = $status[0]['key'];
            }

            $cv = CVs::withTrashed()->findOrfail($request->cv_id);

            if(count($cv) > 0){

                if(isset($cv->file)){

                    $arr = explode('.', $cv->file);
                    $extension = $arr[1];
                    $cv_file_name = md5(uniqid() . microtime());
                    $cv_file_name_ext = $cv_file_name.'.'.$extension;


                    $exists = Storage::exists(config('paths.cv').$cv->file);

                    if(!empty($exists)){

                        $contents = Storage::get(config('paths.cv').$cv->file);
                        Storage::put(config('paths.applications').$cv_file_name_ext, $contents);


                        if(isset($job_id) && isset($status)){

                            $job = Job::findOrfail($job_id);
                            if(count($job) > 0){

                                $job->user()->attach($user_id, [
                                    'cover_letter' => $request->cover_letter,
                                    'cv_id'        => $request->cv_id,
                                    'status'       => $status,
                                    'active'       => 1

                                ]);

                                return redirect()->back()
                                    ->withSuccess('Your have applied Successfully.');

                            }
                        }else{

                            return redirect()->back()
                                ->withErrors('Operation failed. Please try again.');
                        }
                    } else{

                        return redirect()->back()
                            ->withErrors('Operation failed. Please try again.');
                    }

                } else{

                    return redirect()->back()
                        ->withErrors('Operation failed. Please try again.');
                }
            }else{

                return redirect()->back()
                    ->withErrors('Operation failed. Please try again.');
            }
        }
        else{

            return redirect()->back()
                ->withErrors('Operation failed. Please try again.');

        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $logged_user = $user->id;

            $user = User::findOrFail($user->id);

        } else{

            $logged_user = false;
        }

        if(isset($logged_user)){

            $user = User::findOrFail($logged_user);
            if (count($user) > 0){

                $user_cvs = $user->cvs()->where('user_id', '=', $logged_user)->pluck('name', 'id');

                if(isset($user_cvs)  && count($user_cvs) > 0){

                    $user_cvs = $user_cvs->prepend('Choose your cv…', '');
                }
            }
        }

        $FillableDropdown = new FillableDropdown();
        $gender = $FillableDropdown->gender($default = 2);
        $travel = $FillableDropdown->travel($default = 2);

        $job = Job::findOrFail($id);


        return view('jobs.job_detail_page', compact('job', 'user', 'user_cvs', 'gender', 'logged_user', 'travel'));


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove applicant's cv
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }


    /**
     * Remove applicant's cv
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCV($id)
    {
        if(isset($id)){
            
            $cv = CVs::withTrashed()->findOrFail($id);
            if(count($cv) > 0){


                $exists = Storage::exists(config('paths.cv') . $cv->file);
                if (!empty($exists)) {

                    Storage::delete(config('paths.cv') . $cv->file);
                }

                $cv->delete();
                return redirect()->back()->with('success', 'CV is deleted');
            }
        }
    }




    /**
     * Get all CVs by user ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ViewAllCvs($id)
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $user = User::findOrFail($id);
        if(isset($user) && count($user) > 0){

            $userCVs = $user->cvs;
        }

        $sidebar_items = array(
            "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
            "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin',['id'=> $user_id]), 'icon' => '<i class="fa fa-users"></i>'),

        );


        if(count($userCVs) > 0) {

            return view('jobs.viewCVs', compact('job', 'user',  'userCVs', 'jobsByUser', 'sidebar_items'));

        }else{

            return view('jobs.viewCVs', compact('job', 'user', 'jobsByUser', 'sidebar_items'));

        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelJob(Request $request, $id)
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $user = User::find($user_id);

        if (count($user) > 0){

            if($user->jobs){

                if(count($user->jobs) > 0){

                    $job_by_user = $user->jobs()->wherePivot('job_id', '=', $id)->get();

                    if(count($job_by_user) > 0){

                        if(isset($job_by_user[0])){

                            if(!empty($job_by_user[0]->pivot->cv_id)){

                                $cv_id = $job_by_user[0]->pivot->cv_id;
                                $cv = CVs::withTrashed()->findOrFail($cv_id);

                                if(count($cv) > 0){

                                    $exists = Storage::exists(config('paths.applications').$cv->file);
                                    if (!empty($exists)){

                                        Storage::delete(config('paths.applications').$cv->file);
                                        $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user[0]->id);

                                        $request->session()->flash('alert-success', 'Application is canceled!');
                                        return redirect()->back();

                                    }else{

                                        $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user[0]->id);

                                        $request->session()->flash('alert-success', 'Application is canceled!');
                                        return redirect()->back();
                                    }
                                }
                                else{

                                    $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user[0]->id);

                                    $request->session()->flash('alert-success', 'Application is canceled!');
                                    return redirect()->back();
                                }

                            }else{

                                $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user[0]->id);

                                $request->session()->flash('alert-success', 'Application is canceled!');
                                return redirect()->back();
                            }

                        }else{

                            if(!empty($job_by_user->pivot->cv_id)){

                                $cv_id = $job_by_user[0]->pivot->cv_id;
                                $cv = CVs::withTrashed()->findOrFail($cv_id);

                                if(count($cv) > 0){

//                                    $exists = Storage::disk('clientApplications')->exists($cv->file);

                                    $exists = Storage::exists(config('paths.applications').$cv->file);
                                    if (!empty($exists)){

                                        Storage::delete(config('paths.applications').$cv->file);
                                        $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user[0]->id);

                                        $request->session()->flash('alert-success', 'Application is canceled!');
                                        return redirect()->back();

                                    }else{

                                        $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user[0]->id);

                                        $request->session()->flash('alert-success', 'Application is canceled!');
                                        return redirect()->back();
                                    }
                                }else{

                                    $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user[0]->id);

                                    $request->session()->flash('alert-success', 'Application is canceled!');
                                    return redirect()->back();
                                }

                            }else{

                                $user->jobs()->wherePivot('job_id', '=', $id)->detach($job_by_user->id);

                                $request->session()->flash('alert-success', 'Application is canceled!');
                                return redirect()->back();
                            }
                        }
                    }else{

                        return redirect()->back()->withErrors(['Can not delete this Application.']);
                    }
                }

                return redirect()->back()->withErrors('Can not delete this Application.');
            }
            else{

                return redirect()->back()->withErrors(['Can not delete this Application.']);
            }
        }
        else
        {

            return redirect()->back()->with('error', 'Can not delete this Application.');
        }

    }


    /**
     * Download CV by job. Get method
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadCV($id)
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $cv = CVs::withTrashed()->findOrFail($id);

        if(count($cv) > 0){

            $exists = Storage::exists(config('paths.cv').$cv->file);
            if (!empty($exists)){

                if(is_dir(storage_path(). "/app/public/uploads/cv/")) {

                    $url= storage_path(). "/app/public/uploads/cv/".$cv->file;

                    if(isset($url)){

                        return Response::download($url);

                    }else {
                        return redirect()->back()->with('success', 'File could not downable.');

                    }
                }else {
                    return redirect()->back()->with('success', 'File could not accessible.');

                }

            }else {
                return redirect()->back()->with('success', 'File could not accessible. You have delete CV file.');

            }
        }else{
            return redirect()->back()->with('success', 'File could not downable.');

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AppliedJobs()
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $logged_user = $user->id;

        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $FillableDropdown = new FillableDropdown();
        $status = $FillableDropdown->statusByKeyValue($default = 2);


        $user = User::findOrFail($user_id);
        $jobsByUser = $user->jobs;

        return view('jobs.applied_jobs', compact('job', 'user', 'logged_user', 'jobsByUser', 'status'))->with('success', 'Operation is performed. ');
    }

}
