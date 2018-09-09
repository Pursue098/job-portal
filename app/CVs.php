<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CVs extends Model
{

    use SoftDeletes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $table = 'cv';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name',  'description', 'file', 'user_id', 'active', 'created_at', 'updated_at', 'deleted_at'];


    /**
     * Cv belong to user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
