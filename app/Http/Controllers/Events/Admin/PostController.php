<?php

namespace App\Http\Controllers\Events\Admin;

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
use App\PostImages;
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
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        return view('admin/post.list', compact('accessibility', 'active', 'sidebar_items'));
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
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        return view('admin/post.create', compact('accessibility', 'active', 'sidebar_items'));
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
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        $event_id = $id;
        return view('admin/post.create', compact('accessibility', 'active', 'event_id', 'sidebar_items'));
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
            "List Events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            'Add New' => array('url' => URL::route('admin.post.create_post', [$id]), 'icon' => '<i class="fa fa-plus-circle"></i>'),
        );

        $FillableDropdown = new FillableDropdown();
        $active = $FillableDropdown->active($default = 2);
        $accessibility = $FillableDropdown->accessibility($default = 2);

        $posts = Post::where('events_id', '=', $id)->get();
        $event_id = $id;

//        dd($event_id);
        return view('admin/post.list', compact('accessibility', 'active', 'event_id', 'posts', 'sidebar_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $sidebar_items = array(
            "List events" => array('url' => URL::route('admin.event.index'), 'icon' => '<i class="fa fa-users"></i>'),
            "New Post" => array('url' => URL::route('admin.post.create_post', [$id]), 'icon' => '<i class="fa fa-users"></i>'),
        );

//        $event_id = $post->event;

        $event_id = $post->events_id;

        return view('admin/post.edit', compact('post', 'event_id', 'sidebar_items'));

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

        $authentication = \App::make('authenticator');
        $user = $authentication->getLoggedUser();
        if (isset($user) && count($user) > 0) {

            $user_id = $user->id;
        } else{

            return redirect()->route('user.login')->with('error', 'Please login ');
        }

        if(!empty($request->data) && isset($request->event_id) && isset($request->post_id) && isset($request->postText)){


            $event_id = $request->event_id;
            if(isset($event_id)) {

                $event = Events::findOrFail($event_id);
                if (count($event) > 0) {

                        $data = [
                            'postText'    => $request->postText,
                        ];

                        if($data){

                            $post = Post::where('id', $request->post_id)->update($data);
                            if(isset($post)){

                                $imageData = $request->data;
                                if(isset($imageData)){

                                    foreach ($imageData as $index=>$image){

                                        if(isset($image)){

                                            $img = Image::make('assets/images/staticImage/'.$image);
                                            $name = md5(uniqid() . microtime());
                                            $full_name = $name. '.png';
                                            $img->save('assets/images/post/'.$full_name);

                                            $updated_post = Post::findOrFail($request->post_id);

                                            if (count($updated_post) > 0) {

                                                $updated_post->images()->create([
                                                    'name' => $full_name,
                                                ]);
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
                            }else{

                                $response = array(
                                    'status' => 'failed',
                                    'text' => 'Post not updated',
                                );
                                return \Response::json($response);
                            }
                        }
                    }
                else{
                    $response = array(
                        'status' => 'failed',
                        'text' => 'Post not updated',
                    );
                    return \Response::json($response);
                }
            }
            else{
                $response = array(
                    'status' => 'failed',
                    'text' => 'Post not updated',
                );
                return \Response::json($response);
            }
        }
        elseif(isset($request->event_id) && isset($request->postText) && isset($request->post_id) ) {

            $event_id = $request->event_id;
            if (isset($event_id)) {
                $event = Events::findOrFail($event_id);

                if (count($event) > 0) {

                    $data = [
                        'postText'    => $request->postText,
                    ];

                    if($data){

                        $post = Post::where('id', $request->post_id)->update($data);

                        if(isset($post)){

                            $response = array(
                                'status' => 'success',
                                'text' => 'You have make post without images.',
                            );
                            return \Response::json($response);
                        }else{

                            $response = array(
                                'status' => 'failed',
                                'text' => 'Post not updated',
                            );
                            return \Response::json($response);
                        }
                    }
                }
                else{
                    $response = array(
                        'status' => 'failed',
                        'text' => 'Post not updated',
                    );
                    return \Response::json($response);
                }
            }
            else{
                $response = array(
                    'status' => 'failed',
                    'text' => 'Post not updated',
                );
                return \Response::json($response);
            }
        }else{
            $response = array(
                'status' => 'failed',
                'text' => 'Post not updated',
            );
            return \Response::json($response);
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
        $post = Post::findOrFail($id);

        if (count($post) > 0){

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

            $post->delete();

            return redirect()->back()->with('success', 'Post deleted successfully.');
        }
        else
        {

            return redirect()->back()->withErrors(['This post cannot delete.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request)
    {

        if(isset($request->post_id)){

            $post_id = $request->post_id;
        }
        if(isset($request->image_id)){

            $image_id = $request->image_id;
        }
        if(isset($request->image_name)){

            $image_name = $request->image_name;
        }

        if (isset($image_id)){

            $postImages = PostImages::findOrFail($image_id);
            if(count($postImages) > 0){

                $post = $postImages->delete();
                if($post){

                    if (File::isFile('assets/images/post/' . $image_name)) {
                        \File::delete('assets/images/post/' . $image_name);
                    }
                }

            }

            $response = array(
                'status' => 'success',
                'text' => 'Image is removed',
            );
            return \Response::json($response);
        }
        else
        {
            $response = array(
                'status' => 'failed',
                'text' => 'Images could not delete able.;',
            );
            return \Response::json($response);
        }

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
