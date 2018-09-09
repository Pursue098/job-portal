@extends('laravel-authentication-acl::admin.layouts.base-2cols')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title')
    Admin area: Edit Post
@stop


@section('content')
    <div class="row">
        <h2 class="text-center">Edit Job</h2>
        <hr>
        <div class="row">
            <div class="alert alert-success fade in" hidden>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4 class="custom_success_message"><i class="icon fa fa-check"></i> </h4>
            </div>
            <div class="alert alert-danger fade in" hidden>
                <a href="javascript:void(0); " class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4 class="custom_danger_message"><i class="icon fa fa-check"></i> </h4>
            </div>
        </div>
    </div>
    <div class="row">
{{--        {!! Form::model($post, [ 'url' => URL::route('admin.post.update', ['id' => $post->id])] )  !!}--}}
        {{ Form::hidden('_method', 'PUT') }}
        <div class="col-xs-12">
            @if(isset($post))
                <div class="form-group" style="margin-top: 10px;">
                    {!! Form::label('postText', 'Messages', array('class'=>'col-sm-2 control-label', 'style'=>'margin-top:20px;')) !!}
                    <div class="col-sm-6" style="margin-top: 20px;">
                        {!! Form::textarea('postText', $post->postText, array('id' => 'postText', 'class' => 'form-control ckeditor', 'placeholder' => 'write something', 'value' => '', 'col' => 10, 'row' => 2)) !!}
                    </div>
                </div>
                <span class="text-danger postTextWarning">{!! $errors->first('postText') !!}</span>
            @endif

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2" style="margin-top: 10px;">
                    {!! Form::button('Update', array('class' => 'btn btn-primary editPost','type' => 'submit')) !!}

                    @if(isset($event_id))
                        <a class="btn btn-default" href="{{ route('admin.post.show', ['id' => $event_id]) }}">Cancel</a>
                    @endif
                </div>
            </div>

{{--            {!! Form::close() !!}--}}

            @if(isset($event_id))
                {!! Form::open([ 'url' => URL::route('admin.post.dropzone'), 'method' => 'POST', 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal dropzone', 'id' => 'image-upload' ]) !!}
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">
                        {!! Form::label('', "", array('class'=>'col-sm-2 control-label'))!!}
                        <div class="col-sm-12">
                            {{ Form::hidden('invisible', null, array('id' => 'p_invisible_image')) }}
                            @if(isset($event_id) && isset($post->id))
                                {{ Form::hidden('event_id', $event_id, array('id' => 'event_id')) }}
                                {{ Form::hidden('post_id', $post->id, array('id' => 'post_id')) }}
                            @endif
                            <br><br>
                            <span class="text-danger postImagesWarning"></span>
                            <span class="text-danger postImagesSuccess"></span>

                            <div class="row">
                                <div class="alert alert-success fade in" hidden>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <h4 class="delete_success_message"><i class="icon fa fa-check"></i> </h4>
                                </div>
                                <div class="alert alert-danger fade in" hidden>
                                    <a href="javascript:void(0); " class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <h4 class="delete_danger_message"><i class="icon fa fa-check"></i> </h4>
                                </div>
                            </div>

                            <h3 style="text-align: center">Old Uploaded Post Images</h3>
                            <div class="row old-images">
                                <div class="col-xs-12">

                                    @if(count($post->images) > 0)
                                        @foreach($post->images as $index=>$image)

                                            @if(isset($image->name))
                                                <input type="hidden" id="invisible_post_id" value="{{$post->id}}">
                                                <div class="col-xs-2" style="margin-left: -30px;" data-{{$image->id}}="{{$image->id}}">
                                                    <img src="{{url('assets/images/post/'.$image->name)}}" name="old_image" class="old_image" style="float:left; width: 120px; height: 120px; margin-left:20px; border-radius: 20px;">
                                                    <a href="javascript:void(0);" style="margin-left: 40px;" data-id="{{$image->id}}" data-name="{{$image->name}}" class="delete_image_button" aria-label="Delete">Remove file</a>
                                                    <br><br>
                                                </div>

                                            @endif

                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <h3 style="text-align: center">Upload Multiple New Image By Click On Box</h3>

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@stop
@section('footer_scripts')
    <script>


        CKEDITOR.replace( 'postText' );

        (function($) {

            Dropzone.options.imageUpload = {
                maxFilesize : 5,
                addRemoveLinks : true,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                removedfile: function(file) {

                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                }
            };



            $('.delete_image_button').click(function() {

                var confirmation = confirm("Are you sure to delete this item?");

                if(confirmation == true){

                    var image_id = $(this).data("id");
                    var image_name = $(this).data("name");
                    var post_id = $('#invisible_post_id').val();

                    console.log('image_id: ', image_id);
                    console.log('image_name: ', image_name);
                    console.log('image_name: ', image_name);


                    if(image_id && image_name && post_id){

                        var data = {
                            image_id: image_id,
                            image_name: image_name,
                            post_id: post_id
                        }

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                            }
                        });

                        console.log('data: ', data);

                        $.ajax({
                            type  : 'POST',
                            url   : '{{env('APP_URL')}}' + 'admin/delete_image',
                            data  : data,
                            cache : false,
                            success : function(data, textStatus) {
                                if(data.status == 'success'){

                                    console.log('success 1');

                                    $('#invisible_post_id').remove();
                                    $('div[data-'+image_id+'='+image_id+']').remove();

//                                    $( ".postImagesSuccess" ).after( '<div class="alert alert-success">Image is deleted </div>' );

                                    $( ".alert-success" ).show();
                                    $( ".delete_success_message" ).text('Image is deleted');
                                    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                                        $(".alert-success").slideUp(500);
                                    });

                                    console.log('success 2');

                                } else if(data.status == 'failed'){
                                    console.log('failed');

//                                    $( ".postImagesWarning" ).after( '<div class="alert alert-danger">Image not delete </div>' );
                                    $( ".alert-danger" ).show();
                                    $( ".delete_danger_message" ).text('Image could not delete.please refresh page and try again.');
                                    $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
                                        $(".alert-danger").slideUp(500);
                                    });
                                }
                            },
                            error : function(data) {

                                console.log('error');

//                                $( ".postImagesWarning" ).after( '<div class="alert alert-danger">Image not delete</div>' );
                                $( ".alert-danger" ).show();
                                $( ".delete_danger_message" ).text('Image could not delete.please refresh page and try again.');
                                $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
                                    $(".alert-danger").slideUp(500);
                                });
                            }
                        });

                    }else {

                        console.log('invalid');

//                        $( ".postImagesWarning" ).after( '<div class="alert alert-danger">Image not delete</div>' );
                        $( ".alert-danger" ).show();
                        $( ".delete_danger_message" ).text('Image could not delete.please refresh page and try again.');
                        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
                            $(".alert-danger").slideUp(500);
                        });
                        return;
                    }

                }
                return;

            });

            $(".editPost").click(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
                });

                var imageArray = new Array();

                $( "div.dz-preview" ).find( "div.dz-image img" ).each(function( index ) {

                    var value = $( this ).attr( "alt" );
                    imageArray.push(value);

                });

                var postText = CKEDITOR.instances['postText'].getData();
                var event_id = $('#event_id').val();
                var post_id = $('#post_id').val();

                console.log('azam');

                if(post_id && event_id){
                    var data = {
                        data:imageArray,
                        event_id:event_id,
                        post_id:post_id,
                        postText:postText
                    };

                    console.log('data: ', data);

                    $.ajax({
                        type: "PATCH",
                        url: '{{env('APP_URL')}}'+'admin/post/'+post_id,
                        data: data,
                        success: function(data) {
                            console.log('success' ,data);

                            if(data.status == 'success'){

                                $( ".alert-success" ).show();
                                $( ".custom_success_message" ).text(data.text);
                                $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                                    $(".alert-success").slideUp(500);
                                });
                            }
                            return;

                        },
                        error: function(data) {

                            $( ".alert-danger" ).show();
                            $( ".custom_danger_message" ).text(data.text);
                            $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
                                $(".alert-danger").slideUp(500);
                            });
                            console.log(data);
                            return;
                        }
                    },"json");

                }

                return;
            });
        })(jQuery);


    </script>

@stop