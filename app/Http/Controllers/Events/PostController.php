<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\ImageManagerStatic as Image;

use App\Helper\FillableDropdown;
use App\Http\Controllers\Controller;

use App\Events;
use App\Post;
use App\User;
class PostController extends Controller
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
            'Add New Post' => array('url' => URL::route('post.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);
        $operations = $FillableDropdown->eventOperations($default = 2);

        return view('post.list', compact('operations', 'accessibility', 'active', 'sidebar_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sidebar_items = array(
            "List Events" => array('url' => URL::route('event.index'), 'icon' => '<i class="fa fa-users"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        return view('post.create', compact('accessibility', 'active', 'sidebar_items'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request, $id)
    {
        $sidebar_items = array(
            "List Events" => array('url' => URL::route('event.index'), 'icon' => '<i class="fa fa-users"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        $event_id = $id;
        return view('post.create', compact('accessibility', 'active', 'event_id', 'sidebar_items'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();
        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        if(!empty($request->data) && isset($request->event_id) && isset($request->postText)){


            $event_id = $request->event_id;
            if(isset($event_id)) {
                $event = Events::findOrFail($event_id);

                if (count($event) > 0) {

                    $data = [
                        'postText'        => $request->postText,
                        'user_id'         => $user_id,
                        'events_id'       => $event_id,
                    ];

                    if ($data) {

                        $post = Post::create($data);

                        $imageData = $request->data;
                        if(isset($imageData)){

                            foreach ($imageData as $image){

                                if(isset($image)){

                                    $img = Image::make('assets/images/staticImage/'.$image);
                                    $name = md5(uniqid() . microtime());
                                    $full_name = $name. '.png';
                                    $img->save('assets/images/post/'.$full_name);

                                    if (count($post) > 0) {

                                        $post->images()->create([
                                            'name' => $full_name,
                                        ]);
                                    }
                                    else{
                                        $response = array(
                                            'status' => 'success',
                                            'text' => 'You could not make this post. Please try again. Refresh you page. .',
                                        );
                                        return \Response::json($response);
                                    }

                                }
                                else{
                                    $response = array(
                                        'status' => 'success',
                                        'text' => 'You have make post without images.',
                                    );
                                    return \Response::json($response);
                                }
                            }

                            $response = array(
                                'status' => 'success',
                                'text' => 'You have make a post',
                            );
                            return \Response::json($response);
                        }
                        else{
                            $response = array(
                                'status' => 'success',
                                'text' => 'You have make post without images.',
                            );
                            return \Response::json($response);
                        }
                    }
                }
                else{
                    $response = array(
                        'status' => 'success',
                        'text' => 'Event does not exist',
                    );
                    return \Response::json($response);
                }
            }
            else{
                $response = array(
                    'status' => 'success',
                    'text' => 'Event ID does not exist',
                );
                return \Response::json($response);
            }
        }
        elseif(isset($request->event_id) && isset($request->postText) ) {
            $event_id = $request->event_id;
            if (isset($event_id)) {
                $event = Events::findOrFail($event_id);

                if (count($event) > 0) {

                    $data = [
                        'postText' => $request->postText,
                        'user_id' => $user_id,
                        'events_id' => $event_id,
                    ];

                    if ($data) {

                        Post::create($data);

                        $response = array(
                            'status' => 'success',
                            'text' => 'You have make a post',
                        );
                        return \Response::json($response);
                    }
                }
                else{
                    $response = array(
                        'status' => 'success',
                        'text' => 'Event does not exist',
                    );
                    return \Response::json($response);
                }
            }
            else{
                $response = array(
                    'status' => 'success',
                    'text' => 'Event ID does not exist',
                );
                return \Response::json($response);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sidebar_items = array(
            "List Events" => array('url' => URL::route('event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('event.create'), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        $posts = Post::where('events_id', '=', $id)->get();
        $event = Events::findOrFail($id);
        
        $event_id = $id;

        return view('post.post_page', compact('accessibility', 'active', 'event_id', 'event', 'posts', 'sidebar_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('azam');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Method for dropzone( post's ) images.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dropZone(Request $request)
    {

    }

}
