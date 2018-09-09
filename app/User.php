<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \LaravelAcl\Authentication\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * user( admin ) can post many jobs
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Job')
            ->withPivot('cover_letter', 'cv_id', 'status', 'active', 'created_at', 'updated_at')
            ->withTimestamps();
    }



    /**
     * User have multiple CVs
     */
    public function cvs()
    {
        return $this->hasMany('App\CVs');
    }

    /**
     * user( admin ) can post many jobs
     */
    public function events()
    {
        return $this->belongsToMany('App\Events')
            ->withPivot('operation', 'created_at', 'updated_at')
            ->withTimestamps();
    }

    /**
     * Get cv of applicant
     */
    public function getCv($job_id, $applicant_id)
    {

        $job = Job::findOrFail($job_id);
        if(count($job) > 0){

            $job_by_users = $job->user()
                ->wherePivot('job_id', '=', $job_id)
                ->wherePivot('user_id', '=', $applicant_id)
                ->get();

            if(count($job_by_users) > 0){

                if(isset($job_by_users[0])){

                    $cv_id = $job_by_users[0]->pivot->cv_id;
                    if(isset($cv_id)){

                        $cv = CVs::withTrashed()->findOrFail($cv_id);

                        if (isset($cv) && count($cv) > 0){

                            return $cv;
                        }else{

                            return false;
                        }
                    }
                }elseif($job_by_users){

                    $cv_id = $job_by_users->pivot->cv_id;
                    if(isset($cv_id)){

                        $cv = CVs::withTrashed()->findOrFail($cv_id);

                        if (isset($cv) && count($cv) > 0){

                            return $cv;
                        }else{

                            return false;
                        }
                    }
                }

            }
        }

    }
}
