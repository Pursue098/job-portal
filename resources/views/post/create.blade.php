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
                    {!! Form::textarea('postText', null, array('id' => 'postText', 'class' => 'form-control', 'placeholder' => 'write something', 'value' => '', 'col' => 10, 'row' => 2)) !!}
                </div>
            </div>
            <span class="text-danger postTextWarning">{!! $errors->first('postText') !!}</span>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2" style="margin-top: 10px;">
                    {!! Form::button('Create', array('class' => 'btn btn-primary makePost','type' => 'submit')) !!}
                    <a class="btn btn-default" href="{{ route('v1.client.event.index') }}">Cancel</a>
                </div>
            </div>
        </div>
        @if(isset($event_id))
            {!! Form::open([ 'url' => URL::route('v1.admin.post.dropzone'), 'method' => 'POST', 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal dropzone', 'id' => 'image-upload' ]) !!}
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">
                        {!! Form::label('', "", array('class'=>'col-sm-2 control-label'))!!}
                        <div class="col-sm-6">
                            {{ Form::hidden('invisible', null, array('id' => 'p_invisible_image')) }}
                            @if(isset($event_id))
                                {{ Form::hidden('event_id', $event_id, array('id' => 'event_id')) }}
                            @endif
                            <br><br>
                            <div>
                                <h3>Upload Multiple Images By Click On Box</h3>
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
                if( !$('#postText').val() ) {

                    $('.postTextWarning').text('Please write some thing.');
                    return;
                }

                var event_id = $('#event_id').val();
                var postText = $('#postText').val();

                var data = {data:imageArray, event_id:event_id, postText:postText};
                $.ajax({
                    type: "POST",
                    url: '{{env('APP_URL')}}'+'client/v1/post',
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

        $('.post_date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
        });
        $('.apply_by_date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
        });
    </script>

@stop