<?php

namespace App\Http\Controllers\Events\Admin;


use App\Post;
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
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            "Create Events" => array('url' => URL::route('admin.event.create'), 'icon' => '<i class="fa fa-users"></i>'),
            "List subscribed Events" => array('url' => URL::route('admin.event.list_subscribed_event'), 'icon' => '<i class="fa fa-users"></i>'),
            "List un-subscribed Events" => array('url' => URL::route('admin.event.list_unsubscribed_event'), 'icon' => '<i class="fa fa-users"></i>'),

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

        $events = Events::orderBy('name', 'desc')->get();

        return view('admin/events.list', compact('events', 'active', 'users', 'accessibility', 'operations', 'sidebar_items'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sidebar_items = array(
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.event.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        return view('admin/events.create', compact('accessibility', 'active', 'sidebar_items'));
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
            'name'                  => 'required',
            'location'              => 'required',
            'accessibility'         => 'required',
            'active'                => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.event.create')->withInput()->withErrors($validator);
        }

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }


        if(!empty($request->image)){

            $img = Image::make('assets/images/staticImage/'.$request->image);

            $name = md5(uniqid() . microtime());

            $img->save('assets/images/event/'.$name. '.png');

            $full_name = $name. '.png';

        } else{

            $full_name = null;

        }
        $data = [
            'name'            => $request->name,
            'description'     => $request->description,
            'location'        => $request->location,
            'accessibility'   => $request->accessibility,
            'active'          => $request->active,
            'user_id'         => $user_id,
            'image'           => $full_name,

        ];



        if ($data) {

            Events::create($data);
        }

        return redirect()->route('admin.event.index')
            ->withSuccess('Your Eevent is created successfully.');
    }

    /**
     * Subscribe/un-subscribe an event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $event = Events::findOrFail($id);

        if(count($event) > 0){

            $authentication = \App::make('authenticator');
            $logged_user = $authentication->getLoggedUser();

            if (isset($logged_user)) {

                $user_id = $logged_user->id;
            }
            if (isset($user_id)){

                $user = $event->user()
                    ->wherePivot('user_id', '=', $user_id)
                    ->wherePivot('events_id', '=', $id)->get();

                return view('admin/events.eventDetailPage', compact('event', 'user', 'sidebar_items'));

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
        $event = Events::findOrFail($id);

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        $sidebar_items = array(
            "List events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New Event' => array('url' => URL::route('admin.event.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            "New Post" => array('url' => URL::route('admin.post.create_post', [$id]), 'icon' => '<i class="fa fa-users"></i>'),
            "Its Posts" => array('url' => URL::route('admin.post.show', [$id]), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            "List subscribed users" => array('url' => URL::route('admin.event.list_subscribed_user', [$id]), 'icon' => '<i class="fa fa-plus-circle"></i>'),

        );

        return view('admin/events.edit', compact('event', 'active', 'accessibility', 'sidebar_items'));
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
            'name'                  => 'required',
            'location'              => 'required',
            'accessibility'         => 'required',
            'active'                => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.event.edit', $id)
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


        if(!empty($request->image) && !empty($request->invisible)){

            $img = Image::make('assets/images/staticImage/'.$request->image)->resize(1000, 1000);
            $name = md5(uniqid() . microtime());
            $img->save('assets/images/event/'.$name. '.png');
            $full_name = $name. '.png';

            if(File::isFile('assets/images/event/'.$request->invisible)){
                \File::delete('assets/images/event/'.$request->invisible);
            }

            $data = [
                'name'            => $request->name,
                'description'     => $request->description,
                'location'        => $request->location,
                'accessibility'   => $request->accessibility,
                'active'          => $request->active,
                'user_id'         => $user_id,
                'image'           => $full_name,
            ];
        }
        elseif(empty($request->image) && !empty($request->invisible)){

            $full_name = $request->invisible;

            $data = [
                'name'            => $request->name,
                'description'     => $request->description,
                'location'        => $request->location,
                'accessibility'   => $request->accessibility,
                'active'          => $request->active,
                'user_id'         => $user_id,
                'image'           => $full_name,
            ];
        }
        elseif(!empty($request->image) && empty($request->invisible)){

            $img = Image::make('assets/images/staticImage/'.$request->image)->resize(1000, 1000);
            $name = md5(uniqid() . microtime());
            $img->save('assets/images/event/'.$name. '.png');
            $full_name = $name. '.png';

            if(File::isFile('assets/images/event/'.$request->invisible)){
                \File::delete('assets/images/event/'.$request->invisible);
            }

            $data = [
                'name'            => $request->name,
                'description'     => $request->description,
                'location'        => $request->location,
                'accessibility'   => $request->accessibility,
                'active'          => $request->active,
                'user_id'         => $user_id,
                'image'           => $full_name,
            ];
        }
        else{

            $data = [
                'name'            => $request->name,
                'description'     => $request->description,
                'location'        => $request->location,
                'accessibility'   => $request->accessibility,
                'active'          => $request->active,
                'user_id'         => $user_id,
            ];
        }

        if($data){

            Events::where('id', $id)->update($data);
            return redirect()->route('admin.event.index')->withSuccess('Your Event is Successfully Updated.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Events::findOrFail($id);

        if (count($event) > 0){
            if($event->posts){

                if(count($event->posts) > 0){

                    $posts = $event->posts;

                    if(count($posts) > 0){


                        if(isset($event->image)){

                            $image_file = $event->image;
                            if(File::isFile('assets/images/event/'.$image_file)){
                                \File::delete('assets/images/event/'.$image_file);
                            }
                        }

                        foreach ($posts as $post) {

                            $post_images = $post->images->pluck('name');

                            if(count($post_images) > 0){

                                if(count($post_images) > 0) {
                                    foreach ($post_images as $images) {

                                        if (File::isFile('assets/images/post/' . $images)) {
                                            \File::delete('assets/images/post/' . $images);
                                        }
                                    }
                                }
                            }
                        }

                        $event->posts()->delete();
                        $event->delete();

                        return redirect()->route('admin.event.index')->with('success', 'Event is deleted');

                    }else{

                        $event->delete();

                        if(isset($event->image)){

                            $image_file = $event->image;
                            if(File::isFile('assets/images/event/'.$image_file)){
                                \File::delete('assets/images/event/'.$image_file);
                            }
                        }
                        return redirect()->route('admin.event.index')->with('success', 'Event is deleted');
                    }
                }
                else{

                    $event->delete();

                    if(isset($event->image)){

                        $image_file = $event->image;
                        if(File::isFile('assets/images/event/'.$image_file)){
                            \File::delete('assets/images/event/'.$image_file);
                        }
                    }
                    return redirect()->route('admin.event.index')->with('success', 'Event is deleted');
                }
            }
            else{

                $event->delete();

                if(isset($event->image)){

                    $image_file = $event->image;
                    if(File::isFile('assets/images/event/'.$image_file)){
                        \File::delete('assets/images/event/'.$image_file);
                    }
                }
                return redirect()->route('admin.event.index')->with('success', 'Event is deleted');
            }
        }
        else
        {
            return redirect()->route('admin.event.index')->with('error', 'Can not delete this event');

        }
    }

    /**
     * Subscribe an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSubscribedEvents()
    {
        $sidebar_items = array(
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.event.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            "List un-subscribed Events" => array('url' => URL::route('admin.event.list_unsubscribed_event'), 'icon' => '<i class="fa fa-users"></i>'),

        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user)) {

            $user_id = $user->id;
        } else{
            $user_id = 0;

        }

        $user = User::findOrFail($user_id);
        $events = $user->events()->wherePivot('operation', '=', 1)->get();

        return view('admin/events.list', compact('events', 'accessibility', 'active', 'sidebar_items'));
    }

    /**
     * Subscribe an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function listUnSubscribedEvents()
    {
        $sidebar_items = array(
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.event.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
            "List subscribed Events" => array('url' => URL::route('admin.event.list_subscribed_event'), 'icon' => '<i class="fa fa-users"></i>'),

        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();

        if (isset($user)) {

            $user_id = $user->id;
        } else{

            $user_id = 0;
        }

        $user = User::findOrFail($user_id);
        $events = $user->events()->wherePivot('operation', '=', 1)->get();

        return view('admin/events.list', compact('events', 'accessibility', 'active', 'sidebar_items'));
    }

    /**
     * Total user who subscribe that event
     *
     * @return \Illuminate\Http\Response
     */
    public function listSubscribedUsers(Request $request, $id)
    {
        $sidebar_items = array(
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.event.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );

        $event = Events::findOrFail($id);
        $users = $event->user;

        return view('admin/events.subscribedUsers', compact('users', 'event', 'sidebar_items'));
    }



    /**
     * Subscribe/un-subscribe an event.
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
        }

        if (isset($user_id)){

            $user = User::findOrFail($user_id);
            if (count($user) > 0){

                if($user->events){

                    $event = $user->events()->wherePivot('events_id', '=', $e_id)->get();

                    if(count($event) > 0) {
                        if (isset($event[0])) {

                            if (isset($event[0]->pivot->operation)) {

                                $event[0]->pivot->operation = null;
                                $event[0]->pivot->save();

                                return redirect()->route('admin.event.index')->with('success', 'Operation is performed successfully.');
                            }else{

                                $event[0]->pivot->operation = $op_key;
                                $event[0]->pivot->save();
                                return redirect()->route('admin.event.index')->with('success', 'Operation is performed successfully.');
                            }
                        }
                    }
                    else{

                        $user->events()->attach($e_id, ['operation' => $op_key]);
                        return redirect()->route('admin.event.index')->with('success', 'Operation is performed successfully.');
                    }
                }
            }
        }
    }
}
