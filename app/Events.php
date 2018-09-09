<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\FillableDropdown;

class Events extends Model
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $table = 'event';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'location', 'accessibility', 'active', 'user_id', 'image'];


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
     * Event have post
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }


    /**
     * Function to get subscribed event
     */
    public function getEventOperation($id)
    {

        $FillableDropdown = new FillableDropdown();
        $operations = $FillableDropdown->eventOperations($default = 2);

        $event = Events::findOrFail($id);
        if(count($event) > 0){

            $authentication = \App::make('authenticator');
            $user = $authentication->getLoggedUser();

            if (isset($user)) {

                $user_id = $user->id;
            }else{

                $user_id = false;
            }

            if (isset($user_id)) {

                $subscribed_event = $event->user()
                    ->wherePivot('user_id', '=', $user_id)
                    ->select('operation')
                    ->get();

                if(isset($subscribed_event) && $subscribed_event->count() > 0){


                    if(isset($subscribed_event[0])){

                        $op_key = $subscribed_event->first()->operation;
                    }

                    $operation_arr = array();
                    if(count($operations) > 0 && isset($op_key)){

                        foreach (array_values($operations) as $index => $value){

                            if($index%2 == 0){

                                $operation_arr = array_add($operation_arr, $index, $value);
                            }
                            if($op_key == $index && $op_key%2 == 0){

                                $operation_arr = array_add($operation_arr, $index+1, $operations[$index+1]);
                            }
                            if($op_key == $index && $op_key%2 != 0){

                                $operation_arr = array_add($operation_arr, $index-1, $operations[$index-1]);
                            }

                        }


                        if(count($operation_arr) > 0){

                            if (array_key_exists($op_key, $operation_arr)) {

                                $operations = array_except($operation_arr, [$op_key]);

                                return $operations;

                            }else{

                                return false;
                            }

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
            else{
                return false;
            }

        }
    }

    /**
     * Function to get subscribed event
     */
    public function getPosts($id)
    {
        $event = Events::findOrFail($id);
        if(count($event) > 0){

            $event_post = $event->posts;
            if(isset($event_post) && $event_post->count() > 0){

                return true;

            }else{

                return false;
            }
        }
    }    
    
    /**
     * Function to get subscribed event
     */
    public function getEventOwnerUser($id)
    {
        $user = User::findOrFail($id);
        if(count($user) > 0){

            return $user;

        }else{

            return false;
        }

    }
}
