@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Job's area: edit job
@stop

@section('content')
    <div class="row">
        <h2 class="text-center">Create New Job</h2>
        <div class="col-sm-10 col-sm-offset-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissable flat">
                    <a href="javascript:void(0); " class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success alert-dismissable flat">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h4><i class="icon fa fa-check"></i> Success</h4>
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
    {!! Form::open(array('route' => 'admin.jobs.store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="form-group">
        {!! Form::label('title', 'Job Title *', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('title', null, array('id' => 'title', 'class' => 'form-control', 'placeholder'   => 'Job Title','value' => '','required' => 'required')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Job description', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::textarea('description', null, array('id' => 'description', 'class' => 'form-control ckeditor', 'placeholder'   => 'Job description','cols' => '10','rows' => '3')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('specification', 'Job specification', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::textarea('specification', null, array('id' => 'specification', 'class' => 'form-control ckeditor', 'placeholder'   => 'Job Specification','cols' => '10','rows' => '5')) !!}
        </div>
    </div>

    @if(isset($experience))
        <div class="form-group">
            {!! Form::label('experience', 'Job experience *', array('class'=>'col-sm-2 control-label')) !!}
            <div class="col-sm-6">
                {!! Form::select('experience', $experience, null, ['id' => 'experience', 'class' => 'form-control','required' => 'required']) !!}
            </div>
        </div>
    @endif


        <div class="form-group">
        {!! Form::label('location', 'Job location', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('location', null, array('id' => 'location', 'class' => 'form-control', 'placeholder'   => 'Job location','value' => '')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('type', 'Job type', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('type', null, array('id' => 'type', 'class' => 'form-control', 'placeholder'   => 'Job type','value' => '')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('salary_range', 'Salary range *', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('salary_range', null, array('id' => 'salary_range', 'class' => 'form-control', 'placeholder'   => 'Salary range','value' => '','required' => 'required')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('qualification', 'Job Qualification', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-6">
            {!! Form::text('qualification', null, array('id' => 'qualification', 'class' => 'form-control', 'placeholder'   => 'Job Qualification', 'value' => '')) !!}
        </div>
    </div>

    @if(isset($vacancy))
        <div class="form-group">
            {!! Form::label('vacancies', 'Job vacancies *', array('class'=>'col-sm-2 control-label')) !!}
            <div class="col-sm-6">
                {!! Form::select('vacancies', $vacancy, null, ['id' => 'vacancies', 'class' => 'form-control','required' => 'required']) !!}
            </div>
        </div>
    @endif

    {{--!-- gender -->--}}
    @if(isset($gender))
        <div class="form-group">
            <div class="col-sm-2">
                {!! Form::label('gender', "Gender * ", ['style'=>'float:right']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::select('gender', $gender, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <span class="text-danger">{!! $errors->first('gender') !!}</span>
    @endif

    {{--!-- gender -->--}}
    @if(isset($travel))
        <div class="form-group">
            <div class="col-sm-2">
                {!! Form::label('travel', "Travel ", ['style'=>'float:right']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::select('travel', $travel, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <span class="text-danger">{!! $errors->first('travel') !!}</span>
    @endif

    <div class="form-group">
        {!! Form::label('last Date for Applicants', 'last_date *', array('class'=>'col-sm-2 control-label')) !!}
        <!-- Delivery date & time field -->
        <div class="col-sm-6">
            <div class='input-group last_date'>
                {!! Form::text('last_date', null, ['id' => 'last_date','class' => 'form-control last_date',
                 'style' => 'border-radius: 0px']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
    </div>

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
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            {!! Form::button('Create', array('class' => 'btn btn-primary','type' => 'submit')) !!}
            <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@stop
@section('footer_scripts')
    <script>

        $('.last_date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
        });

        CKEDITOR.replace( 'description' );
        CKEDITOR.replace( 'specification' );

//        $('textarea .description').ckeditor();
//        $('textarea .specification').ckeditor();

    </script>

@stop