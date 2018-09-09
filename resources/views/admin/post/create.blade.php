@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Job's area: Create Post
@stop

@section('content')
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

    <div class="row">
        <h2 class="text-center">Create New post</h2>
    </div>
    <div class="row">
        <div class="col-xs-12" style="margin-bottom: 10px; margin-top: 10px;">
            <div class="form-group">
                {!! Form::label('postText', 'Messages', array('class'=>'col-sm-2 control-label')) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('postText', null, array('id' => 'postText', 'class' => 'form-control ckeditor', 'placeholder' => 'write something', 'col' => 10, 'row' => 2)) !!}
                </div>
            </div>
            <span class="text-danger postTextWarning">{!! $errors->first('postText') !!}</span>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2" style="margin-top: 10px;">
                    {!! Form::button('Create', array('class' => 'btn btn-primary makePost','type' => 'submit')) !!}
                    <a class="btn btn-default" href="{{ route('admin.event.index') }}">Cancel</a>
                </div>
            </div>
        </div>
        @if(isset($event_id))
            {!! Form::open([ 'url' => URL::route('admin.post.dropzone'), 'method' => 'POST', 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal dropzone', 'id' => 'image-upload' ]) !!}
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">
                        {!! Form::label('', "", array('class'=>'col-sm-2 control-label'))!!}
                        <div class="col-sm-6">
                            {{ Form::hidden('invisible', null, array('id' => 'p_invisible_image')) }}
                            @if(isset($event_id))
                                {{ Form::hidden('event_id', $event_id, array('id' => 'event_id')) }}
                            @endif
                            <br><br>
                            <span class="text-danger postImagesWarning"></span>
                            <div>
                                <h3>Upload Multiple Image By Click On Box</h3>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        @endif

    </div>
@stop
@section('footer_scripts')
    <script>

        CKEDITOR.replace( 'postText',{
            width: '100%',
            height: 100,
            toolbar:  [
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                { name: 'styles', items: [ 'Styles', 'Format' ] },
            ]
        } );

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

            $(".makePost").click(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
                });

                var imageArray = new Array();

                $( "div.dz-preview" ).find( "div.dz-image img" ).each(function( index ) {

                    var value = $( this ).attr( "alt" );
                    imageArray.push(value);
                    console.log(value);


                });

                var postText = CKEDITOR.instances['postText'].getData();
                var event_id = $('#event_id').val();

                if( !postText && imageArray.length === 0) {

                    $( ".alert-danger" ).show();
                    $( ".custom_danger_message" ).text('Please write some thing in editor or choose some photos.');
                    $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
                        $(".alert-danger").slideUp(500);
                    });

                    return;
                }

                var data = {
                    data:imageArray,
                    event_id:event_id,
                    postText:postText
                };

                $.ajax({
                    type: "POST",
                    url: '{{env('APP_URL')}}'+'admin/post',
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

                return;
            });

        })(jQuery);

    </script>

@stop