@extends('laravel-authentication-acl::admin.layouts.base-2cols')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title')
    Admin area: edit job
@stop


@section('content')
    <div class="row">
        <h2 class="text-center">Edit Event</h2>
        <hr>
    </div>
    <div class="row">
        {!! Form::model($event, [ 'url' => URL::route('admin.event.update', ['id' => $event->id])] )  !!}
        {{ Form::hidden('_method', 'PUT') }}
        <div class="col-xs-12">

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">
                    {!! Form::label('name', 'Event Title', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name',  $event->name, array('id' => 'title', 'class' => 'form-control', 'placeholder'   => 'Event name','value' => '','required' => 'required')) !!}
                    </div>
                </div>
            </div>
            <span class="text-danger">{!! $errors->first('name') !!}</span>

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('description', 'Description', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('description', $event->description, array('id' => 'description', 'class' => 'form-control ckeditor', 'placeholder' => 'Event description', 'col' => 10, 'row' => 2)) !!}
                    </div>
                </div>
            </div>
            <span class="text-danger">{!! $errors->first('description') !!}</span>

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('location', 'Its Location', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('location', $event->location, array('id' => 'location', 'class' => 'form-control', 'placeholder'   => 'Your location','value' => '')) !!}
                    </div>
                </div>
            </div>
            <span class="text-danger">{!! $errors->first('location') !!}</span>

            {{--!-- gender -->--}}
            @if(isset($accessibility))

                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">
                        {!! Form::label('accessibility', "Accessibility: ", array('class'=>'col-sm-2 control-label'))!!}
                        <div class="col-sm-6">
                            {!! Form::select('accessibility', $accessibility, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <span class="text-danger">{!! $errors->first('accessibility') !!}</span>
            @endif

            {{--!-- gender -->--}}
            @if(isset($active))
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">

                        {!! Form::label('active', "Active: ", array('class'=>'col-sm-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::select('active', $active, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <span class="text-danger">{!! $errors->first('active') !!}</span>
            @endif


            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">
                    {!! Form::label('image', "Image: ", array('class'=>'col-sm-2 control-label'))!!}
                    <div class="col-sm-6">
                        @if(isset($event->image))
                            {{ Form::hidden('invisible', $event->image, array('id' => 'p_invisible_image')) }}
                            {{ Form::image(url('assets/images/event/'.$event->image), 'p_old_image', array("class"=>"p_old_image", "style" => "width: 50px; height: 50px; margin-left:20px; border: 1px solid black;")) }}
                            <br><br>
                            {!! Form::file('image', ['id' =>'fileinput', 'class' => 'form-control']) !!}
                        @else
                            {!! Form::file('image', ['id' =>'fileinput', 'class' => 'form-control']) !!}
                        @endif
                    </div>
                </div>
            </div>
            <span class="text-danger">{!! $errors->first('accessibility') !!}</span>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2" style="margin-bottom: 10px">
                    {!! Form::button('Update', array('class' => 'btn btn-primary','type' => 'submit')) !!}
                    <a class="btn btn-default" href="{{ route('admin.event.index') }}">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('footer_scripts')
    <script>

        (function($) {


            $('#fileinput').on('change', function (event, files, label) {
                var file_name = this.value.replace(/\\/g, '/').replace(/.*\//, '')

                $('.p_old_image').attr('src', '{{env('APP_URL')}}'+'assets/images/staticImage/'+file_name);
                $('#p_invisible_image').val(file_name);
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

        CKEDITOR.replace( 'description' );

    </script>

@stop