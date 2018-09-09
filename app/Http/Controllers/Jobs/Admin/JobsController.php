<?php

namespace App\Http\Controllers\Jobs\Admin;

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


class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $FillableDropdown = new FillableDropdown();
        $gender = $FillableDropdown->gender($default = 2);
        $travel = $FillableDropdown->travel($default = 2);
        $experience = $FillableDropdown->experience($default = 2);
        $vacancy = $FillableDropdown->vacancy($default = 2);
        $active = $FillableDropdown->active($default = 2);

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();


        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $user = User::findOrFail($user_id);

        $jobsByUser = $user->jobs()->wherePivot('user_id', '=', $user_id)->get();

        $deactive_jobs = Job::orderBy('title', 'asc')->where('active', '=', 0)->get();

        if(count($jobsByUser) > 0) {
            if(count($deactive_jobs) > 0) {

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin', ['id' => $user_id]), 'icon' => '<i class="fa fa-users"></i>'),
                    "Deactive Jobs" => array('url' => URL::route('admin.deactive-jobs'), 'icon' => '<i class="fa fa-users"></i>'),
                );


                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 1)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }else{

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin', ['id' => $user_id]), 'icon' => '<i class="fa fa-users"></i>'),
                );


                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 1)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }
        }elseif(count($deactive_jobs) > 0){

            if(count($jobsByUser) > 0) {

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin', ['id' => $user_id]), 'icon' => '<i class="fa fa-users"></i>'),
                    'Deactive Jobs' => array('url' => URL::route('admin.deactive-jobs'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                );

                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 1)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }else{

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    'Deactive Jobs' => array('url' => URL::route('admin.deactive-jobs'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                );

                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 1)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }
        }else{

            $sidebar_items = array(
                "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            );

            $jobs = Job::orderBy('title', 'desc')->where('active', '=', 1)->paginate(20);

            return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sidebar_items = array(
            "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );
        
        $FillableDropdown = new FillableDropdown();
        $gender = $FillableDropdown->gender($default = 2);
        $travel = $FillableDropdown->travel($default = 2);
        $experience = $FillableDropdown->experience($default = 2);
        $vacancy = $FillableDropdown->vacancy($default = 2);
        $active = $FillableDropdown->active($default = 2);

        return view('admin/jobs.create', compact('gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'                 => 'required',
            'vacancies'             => 'required',
            'experience'            => 'required',
            'salary_range'          => 'required',
            'gender'                => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.jobs.create')->withInput()->withErrors($validator);
        }

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $data = [
            'title'           => $request->title,
            'description'     => $request->description,
            'experience'      => $request->experience,
            'specification'   => $request->specification,
            'location'        => $request->location,
            'type'            => $request->type,
            'salary_range'    => $request->salary_range,
            'qualification'   => $request->qualification,
            'vacancies'       => $request->vacancies,
            'gender'          => $request->gender,
            'travel'          => $request->travel,
            'user_id'         => $user_id,
            'last_date'       => $request->last_date,
            'active'          => $request->active,
        ];


        if ($data) {

            Job::create($data);
        }
        return redirect()->back()
            ->withSuccess('Your Job is Successfully posted.');
    }

    /**
     * Display job by id and its applications.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $FillableDropdown = new FillableDropdown();
        $gender = $FillableDropdown->gender($default = 2);
        $travel = $FillableDropdown->travel($default = 2);
        $experience = $FillableDropdown->experience($default = 2);
        $vacancy = $FillableDropdown->vacancy($default = 2);
        $active = $FillableDropdown->active($default = 2);
        $status = $FillableDropdown->statusByKeyValue($default = 2);


        if (isset($id)){
            
            $job = Job::findOrFail($id);

            $sidebar_items = array(
                "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            );

            return view('admin/jobs.jobDetails', compact('job', 'gender', 'travel', 'status', 'experience', 'vacancy', 'active', 'sidebar_items'));

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $FillableDropdown = new FillableDropdown();
        $gender = $FillableDropdown->gender($default = 2);
        $travel = $FillableDropdown->travel($default = 2);
        $experience = $FillableDropdown->experience($default = 2);
        $vacancy = $FillableDropdown->vacancy($default = 2);
        $active = $FillableDropdown->active($default = 2);

        $job = Job::findOrFail($id);

        $sidebar_items = array(
            "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            'Applications' => array('url' => URL::route('admin.application-by-job', ['id'=>$id]), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );

        return view('admin/jobs.edit', compact('job', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

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

        $validator = Validator::make($request->all(), [
            'title'                 => 'required',
            'vacancies'             => 'required',
            'experience'            => 'required',
            'salary_range'          => 'required',
            'gender'                => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.jobs.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{
            return redirect()->route('user.login')->with('error', 'Please login ');

        }
        // store
        $data = [
            'title'           => $request->title,
            'description'     => $request->description,
            'experience'      => $request->experience,
            'specification'   => $request->specification,
            'location'        => $request->location,
            'type'            => $request->type,
            'salary_range'    => $request->salary_range,
            'qualification'   => $request->qualification,
            'vacancies'       => $request->vacancies,
            'gender'          => $request->gender,
            'travel'          => $request->travel,
            'last_date'       => $request->last_date,
            'active'          => $request->active,
            'user_id'         => $user_id,
        ];


        Job::where('id', $id)->update($data);
        return redirect()->back()->withSuccess('Your Job is Successfully Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);


        if (count($job) > 0){


            if($job->user){

                if(count($job->user) > 0){

                    $users[] = $job->user;

                    if(isset($users[0])){

                        $users = $users[0];
                        foreach ($users as $user){
                            $users_ids[] = $user->id;
                        }

                        if(isset($users_ids)){

                            if (count($job) > 0) {
                                if ($job->user) {

                                    if (count($job->user) > 0) {

                                        $job_by_users = $job->user()->wherePivot('job_id', '=', $id)->get();

                                        if (count($job_by_users) > 0) {

                                            foreach ($job_by_users as $job_by_user){

                                                if (!empty($job_by_user->pivot->cv_id)) {

                                                    $cv_id = $job_by_user->pivot->cv_id;
                                                    $cv = CVs::withTrashed()->findOrFail($cv_id);

                                                    if (count($cv) > 0) {

                                                        $exists = Storage::exists(config('paths.applications') . $cv->file);
                                                        if (!empty($exists)) {

                                                            Storage::delete(config('paths.applications') . $cv->file);
                                                        }
                                                    }
                                                }
                                            }

                                            $job->user()->detach([$users_ids]);
                                            $job->delete();
                                            return redirect()->route('admin.jobs.index')->with('success', 'Job is deleted');

                                        }else{

                                            return redirect()->back()->withErrors(['Can not delete this job']);

                                        }
                                    }else{

                                        return redirect()->back()->withErrors(['Can not delete this job']);

                                    }
                                }else{

                                    return redirect()->back()->withErrors(['Can not delete this job']);

                                }
                            }else{

                                return redirect()->back()->withErrors(['Can not delete this job']);

                            }

                        }
                        else{

                            return redirect()->back()->withErrors(['Can not delete this job']);

                        }
                    }
                    else{

                        foreach ($users as $user){
                            $users_ids[] = $user->id;
                        }

                        if(isset($users_ids)){

                            if (count($job) > 0) {
                                if ($job->user) {

                                    if (count($job->user) > 0) {

                                        $job_by_users = $job->user()->wherePivot('job_id', '=', $id)->get();

                                        if (count($job_by_users) > 0) {

                                            foreach ($job_by_users as $job_by_user){

                                                if (isset($job_by_user)) {

                                                    if (!empty($job_by_user->pivot->cv_id)) {


                                                        $cv_id = $job_by_user->pivot->cv_id;
                                                        $cv = CVs::withTrashed()->findOrFail($cv_id);

                                                        if (count($cv) > 0) {

                                                            $exists = Storage::exists(config('paths.applications') . $cv->file);
                                                            if (!empty($exists)) {

                                                                Storage::delete(config('paths.applications') . $cv->file);

                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            $job->user()->detach([$users_ids]);
                                            $job->delete();
                                            return redirect()->route('admin.jobs.index')->with('success', 'Job is deleted');

                                        }else{

                                            return redirect()->back()->withErrors(['Can not delete this job']);

                                        }
                                    }else{

                                        return redirect()->back()->withErrors(['Can not delete this job']);

                                    }
                                }else{

                                    return redirect()->back()->withErrors(['Can not delete this job']);

                                }
                            }else{

                                return redirect()->back()->withErrors(['Can not delete this job']);

                            }

                        }else{

                            return redirect()->back()->withErrors(['Can not delete this job']);

                        }
                    }

                }else{

                    $job->delete();
                    return redirect()->route('admin.jobs.index')->with('success', 'Job is deleted');

                }

            }
            else{

                $job->delete();
                return redirect()->route('admin.jobs.index')->with('success', 'Job is deleted');

            }
        } else {

            return redirect()->route('admin.jobs.index')->with('error', 'Can not delete this job');
        }

    }



    /**
     * Remove the job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelApplication(Request $request, $job_id)
    {

        if(isset($request->applicant)){

            $user = User::find($request->applicant);
        }

        if (isset($user) && count($user) > 0){
            if($user->jobs){

                if(count($user->jobs) > 0 && isset($job_id)){

                    $job_by_user = $user->jobs()->wherePivot('job_id', '=', $job_id)->get();

                    if(count($job_by_user) > 0){

                        if(isset($job_by_user[0])){

                            if(!empty($job_by_user[0]->pivot->cv_id)){

                                $cv_id = $job_by_user[0]->pivot->cv_id;
                                $cv = CVs::withTrashed()->findOrFail($cv_id);

                                if(count($cv) > 0) {

                                    $exists = Storage::exists(config('paths.applications').$cv->file);
                                    if (!empty($exists)) {

                                        Storage::delete(config('paths.applications').$cv->file);
                                        $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user[0]->id);

                                        return redirect()->back()->with('success', 'Application is canceled');
                                    } else {

                                        $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user[0]->id);
                                        return redirect()->back()->with('success', 'Application is canceled');
                                    }
                                }else {

                                    $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user[0]->id);
                                    return redirect()->back()->with('success', 'Application is canceled');
                                }
                            }else{

                                $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user[0]->id);
                                return redirect()->back()->with('success', 'Application is canceled');
                            }


                        }else{

                            if(!empty($job_by_user->pivot->cv_id)){

                                $cv_id = $job_by_user->pivot->cv_id;
                                $cv = CVs::withTrashed()->findOrFail($cv_id);

                                if(count($cv) > 0) {

                                    $exists = Storage::exists(config('paths.applications').$cv->file);
                                    if (!empty($exists)) {

                                        Storage::delete(config('paths.applications').$cv->file);
                                        $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user->id);

                                        return redirect()->back()->with('success', 'Application is canceled');
                                    } else {

                                        $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user->id);
                                        return redirect()->back()->with('success', 'Application is canceled');
                                    }
                                }else {

                                    $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user->id);
                                    return redirect()->back()->with('success', 'Application is canceled');
                                }
                            }else{

                                $user->jobs()->wherePivot('job_id', '=', $job_id)->detach($job_by_user->id);
                                return redirect()->back()->with('success', 'Application is canceled');
                            }
                        }
                    }else{

                        return redirect()->back()->withErrors(['Application cannot cancele']);
                    }
                }

                return redirect()->back()->withErrors('Application cannot cancele');
            }
            else{

                return redirect()->back()->withErrors(['Application cannot cancele']);
            }
        }
        else
        {

            return redirect()->back()->withErrors(['Application cannot cancele']);
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

        $user = User::findOrFail($user_id);
        $jobsByUser = $user->jobs()->wherePivot('user_id', '=', $user_id)->get();

        $sidebar_items = array(
            "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
            "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin',['id'=> $user_id]), 'icon' => '<i class="fa fa-users"></i>'),

        );

        if(count($jobsByUser) > 0) {

            if(isset($user[0])){
                $user = $user[0];
            }
            return view('admin/jobs.viewCVs', compact('job', 'user', 'jobsByUser', 'sidebar_items'));

        }else{

            if(isset($user[0])){
                $user = $user[0];
            }
            return view('admin/jobs.viewCVs', compact('job', 'user', 'jobsByUser', 'sidebar_items'));

        }
    }

    /**
     * Get all applications for a job. Get method
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jobStatus($id)
    {

        $job = Job::findOrFail($id);
        if(count($job) > 0){
            if($job->active == 1){

                Job::where('id', $id)->update(array('active' => 0));
                return redirect()->back()->withSuccess('Now this job is deactivated.');

            }elseif($job->active == 0){

                Job::where('id', $id)->update(array('active' => 1));
                return redirect()->back()->withSuccess('Now this job is actived.');

            }
        }
    }

    /**
     * get all applied jobs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AppliedJobs($id)
    {

        $FillableDropdown = new FillableDropdown();
        $status = $FillableDropdown->statusByKeyValue($default = 2);

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $user = User::findOrFail($user_id);
        $jobsByUser = $user->jobs()->wherePivot('user_id', '=', $user_id)->get();

        if(count($jobsByUser) > 0) {

            $sidebar_items = array(
                "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                "All CVs" => array('url' => URL::route('admin.viewAllCvsByAdmin',['id'=> $user_id]), 'icon' => '<i class="fa fa-users"></i>'),
            );
            return view('admin/jobs.appliedJobs', compact('job', 'jobsByUser', 'status', 'sidebar_items'));

        }else{

            $sidebar_items = array(
                "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
            );
            return view('admin/jobs.appliedJobs', compact('job', 'jobsByUser', 'status', 'sidebar_items'));

        }
    }

    
    /**
     * Change application status to viewed, un-viewed, deliverd, rejected, hired etc. Get method
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applicationStatus(Request $request)
    {

        if($request->has('user_id')){

            $user_id = $request->user_id;
        }
        if($request->has('status')){

            $status = $request->status;
        }
        if($request->has('job_id')){

            $job_id = $request->job_id;
        }

        if (isset($user_id) && isset($status) && isset($job_id)) {

            $user = User::findOrFail($user_id);
            if(count($user) > 0){

                $job_user = $user->jobs()
                    ->wherePivot('user_id', '=', $user_id)
                    ->wherePivot('job_id', '=', $job_id)
                    ->get();

                if(count($job_user) > 0){
                    if(isset($job_user[0])){
                        if(isset($job_user[0]->pivot->status)){

                            $job_user[0]->pivot->status = $status;
                            $job_user[0]->pivot->save();

                            $response = array(
                                'status' => 'success',
                            );
                            return \Response::json($response);

                        }else{

                            $response = array(
                                'status' => 'failed',
                            );
                            return \Response::json($response);
                        }
                    }else{

                        $response = array(
                            'status' => 'failed',
                        );
                        return \Response::json($response);
                    }
                }else{

                    $response = array(
                        'status' => 'failed',
                    );
                    return \Response::json($response);
                }
            }

        }else{

            $response = array(
                'status' => 'failed',
            );
            return \Response::json($response);
        }
    }


    /**
     * Get all applications for a job. Get method
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applicationsByjob($id)
    {

        $FillableDropdown = new FillableDropdown();
        $status = $FillableDropdown->statusByKeyValue($default = 2);

        $job = Job::findOrFail($id);
        $job_id = $id;
        
        if(count($job) > 0){
            if(isset($job->user)){

                $applicants = $job->user;
            }
        }


        $sidebar_items = array(
            "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );

        return view('admin/jobs.applications', compact('job_id', 'job', 'applicants', 'status', 'sidebar_items'));


    }


    /**
     * Download CV. Get method
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadCV($id)
    {

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
                    return redirect()->back()->with('success', 'File could not downable.');

                }

            }else {
                return redirect()->back()->with('success', 'File could not downable.');

            }
        }else{
            return redirect()->back()->with('success', 'File could not downable.');

        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactiveJobs()
    {

        $FillableDropdown = new FillableDropdown();
        $gender = $FillableDropdown->gender($default = 2);
        $travel = $FillableDropdown->travel($default = 2);
        $experience = $FillableDropdown->experience($default = 2);
        $vacancy = $FillableDropdown->vacancy($default = 2);
        $active = $FillableDropdown->active($default = 2);

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();


        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        $user = User::findOrFail($user_id);

        $jobsByUser = $user->jobs()->wherePivot('user_id', '=', $user_id)->get();

        $active_jobs = Job::orderBy('title', 'asc')->where('active', '=', 1)->get();

        if(count($jobsByUser) > 0) {
            if(count($active_jobs) > 0) {

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin', ['id' => $user_id]), 'icon' => '<i class="fa fa-users"></i>'),
                    "Active Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                );


                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 0)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }else{

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin', ['id' => $user_id]), 'icon' => '<i class="fa fa-users"></i>'),
                );


                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 0)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }
        }elseif(count($active_jobs) > 0){

            if(count($jobsByUser) > 0) {

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    "Applied Jobs" => array('url' => URL::route('admin.appliedJobsByAdmin', ['id' => $user_id]), 'icon' => '<i class="fa fa-users"></i>'),
                    'Active Jobs' => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                );

                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 0)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }else{

                $sidebar_items = array(
                    "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                    'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                    'Active Jobs' => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
                );

                $jobs = Job::orderBy('title', 'desc')->where('active', '=', 0)->paginate(20);

                return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

            }
        }else{

            $sidebar_items = array(
                "List Jobs" => array('url' => URL::route('admin.jobs.index'), 'icon' => '<i class="fa fa-users"></i>'),
                'Add New' => array('url' => URL::route('admin.jobs.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            );

            $jobs = Job::orderBy('title', 'desc')->where('active', '=', 0)->paginate(20);

            return view('admin/jobs.list', compact('jobs', 'gender', 'travel', 'experience', 'vacancy', 'active', 'sidebar_items'));

        }
    }

}