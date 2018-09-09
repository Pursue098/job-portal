<?php

namespace App\Http\Controllers\Events;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

use App\Helper\FillableDropdown;
use App\Http\Controllers\Controller;

use App\Events;
use App\User;
use App\Post;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sidebar_items = array(
            "List Events" => array('url' => URL::route('event.index'), 'icon' => '<i class="fa fa-users"></i>'),
        );
        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);
        $operations = $FillableDropdown->eventOperations($default = 2);

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user)) {

            $user_id = $user->id;
        }

        if (isset($user_id)) {

            $users = User::findOrFail($user_id);
        }
        $events = Events::orderBy('name', 'asc')->paginate(20);

        return view('events.event_listing_page', compact('events', 'users', 'active', 'accessibility', 'operations', 'sidebar_items'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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

        if (isset($user)) {

            $logged_user = $user->id;
        }else{
            
            $logged_user = false;
        }

        $FillableDropdown = new FillableDropdown();
        $accessibility = $FillableDropdown->accessibility($default = 2);
        $travel = $FillableDropdown->travel($default = 2);

        if(isset($id)){

            $event = Events::findOrFail($id);
        }

//        dd($event->posts[0]->created_at->toFormattedDateString());
        return view('events.event_detail_page', compact('event', 'accessibility', 'logged_user', 'travel'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eventOperation($e_id, $op_key)
    {

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user)) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        if (isset($user_id)){

            $user = User::findOrFail($user_id);
            if (count($user) > 0){

                if($user->events){

                    $event = $user->events()->wherePivot('events_id', '=', $e_id)->get();

                    if(count($event) > 0) {
                        if (isset($event[0])) {


                            if (isset($event[0]->pivot->operation)) {

                                $event[0]->pivot->operation = $op_key;
                                $event[0]->pivot->save();

                                return redirect()->route('event.index')->with('success', 'Operation is performed successfully.');
                            }
                        }
                    }
                    else{

                        $user->events()->attach($e_id, ['operation' => $op_key]);
                        return redirect()->route('event.index')->with('success', 'Operation is performed successfully.');
                    }
                }
            }
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

}
