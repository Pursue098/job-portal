<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $table = 'jobs';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $dates = ['last_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'experience', 'specification',
        'location', 'type', 'salary_range', 'qualification', 'vacancies', 'gender',
        'travel', 'last_date', 'active', 'user_id', 'created_at', 'updated_at'];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * Jobs posted by user
     */
    public function user()
    {
        return $this->belongsToMany('App\User')
            ->withPivot('cover_letter', 'cv_id', 'status', 'active', 'created_at', 'updated_at')
            ->withTimestamps();
    }



    /**
     * Function to verify this job is already applied or not.
     */
    public function appliedOrNot($id)
    {
        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{
            $user_id = false;
        }


        $job = Job::findOrFail($id);
        if (isset($job) && count($job) > 0 && isset($user_id)){

            $job_user = $job->user()->wherePivot('user_id', '=', $user_id)->get();

            if(isset($job_user) && count($job_user) > 0) {

                return true;
            }else{

                return false;
            }
        }else{
            return false;

        }
    }
}
