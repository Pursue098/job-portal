<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImages extends Model
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $table = 'post_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'name'];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    
    /**
     * Postimages belong with post
     */
    public function post()
    {
        return $this->belongsTo('App\Events');
    }
}
