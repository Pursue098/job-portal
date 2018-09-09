@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Job's area: Create event
@stop

@section('content')
    <div class="row">
        <h2 class="text-center">Create New Event</h2>
    </div>
    <div class="row">
    {!! Form::open(array('route' => 'admin.event.store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="form-group">
        {!! Form::label('title', 'Event name', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control', 'placeholder'   => 'Event name','value' => '','required' => 'required')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Event description', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::textarea('description', null, array('id' => 'description', 'class' => 'form-control ckeditor', 'placeholder' => 'Event description', 'col' => 10, 'row' => 2)) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('location', 'Its location', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('location', null, array('id' => 'location', 'class' => 'form-control', 'placeholder'   => 'Event location','value' => '')) !!}
        </div>
    </div>

    {{--!-- gender -->--}}
    @if(isset($accessibility))
        <div class="form-group">
            <div class="col-sm-2">
                {!! Form::label('accessibility', "Accessibility: ", ['style'=>'float:right']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::select('accessibility', $accessibility, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <span class="text-danger">{!! $errors->first('accessibility') !!}</span>
    @endif

    {{--!-- gender -->--}}
    @if(isset($active))
        <div class="form-group">
            <div class="col-sm-2">
                {!! Form::label('active', "Active: ", ['style'=>'float:right']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::select('active', $active, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <span class="text-danger">{!! $errors->first('active') !!}</span>
    @endif

    {{--!-- image -->--}}
    <div class="form-group">
        <div class="col-sm-2">
            {!! Form::label('image', "Image: ", ['style'=>'float:right']) !!}
        </div>
        <div class="col-sm-6">
            {!! Form::file('image') !!}
        </div>
    </div>
    <span class="text-danger">{!! $errors->first('image') !!}</span>


    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            {!! Form::button('Create', array('class' => 'btn btn-primary','type' => 'submit')) !!}
            <a class="btn btn-default" href="{{ route('admin.event.index') }}">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@stop
@section('footer_scripts')
    <script>


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