<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobUsers extends Model
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $table = 'job_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id', 'user_id', 'cover_letter', 'status', 'cv_id', 'active', 'created_at', 'updated_at'];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;



    /**
     * User have multiple CVs
     */
    public function cvs()
    {
        return $this->hasMany('App\CVs');
    }
}
