<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['postText', 'user_id', 'events_id'];


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
            ->withPivot('operation','created_at', 'updated_at')
            ->withTimestamps();
    }


    /**
     * Post have images
     */
    public function images()
    {
        return $this->hasMany('App\PostImages');
    }


    /**
     * Posts belong to
     */
    public function event()
    {
        return $this->belongsTo('App\Events');
    }


    /**
     * Function to get subscribed event
     */
    public function getPostUser($id)
    {
        $post = Post::findOrFail($id);
        if(count($post) > 0){

            if (isset($post->user_id)){

                $user_id = $post->user_id;
                $user = User::findOrFail($user_id);

                if(count($user) > 0){

                    return $user;
                }else{

                    return false;
                }

            }else{

                return false;
            }

        }else{

            return false;
        }

    }
}
