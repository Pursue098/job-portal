@extends('laravel-authentication-acl::admin.layouts.base-2cols')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title')
    Admin area: edit job
@stop


@section('content')
    <div class="row">
        <h2 class="text-center">Edit Job</h2>
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
        <hr>
    </div>
    <div class="row">
        {!! Form::model($job, [ 'url' => URL::route('admin.jobs.update', ['id' => $job->id])] )  !!}
        {{ Form::hidden('_method', 'PUT') }}
        <div class="col-xs-12">

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">
                    {!! Form::label('title', 'Job Title *', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('title',  $job->title, array('id' => 'title', 'class' => 'form-control', 'placeholder'   => 'Job Title','value' => '','required' => 'required')) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('description', 'Job description', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('description', $job->description, array('id' => 'description', 'class' => 'form-control ckeditor', 'placeholder'   => 'Job description','cols' => '10','rows' => '5')) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('specification', 'Job specification', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('specification', $job->specification, array('id' => 'specification', 'class' => 'form-control ckeditor', 'placeholder'   => 'Job specification','cols' => '10','rows' => '5')) !!}
                    </div>
                </div>
            </div>

            @if(isset($experience))
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">

                        {!! Form::label('experience', 'Job experience *', array('class'=>'col-sm-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::select('experience', $experience, null, ['id' => 'experience', 'class' => 'form-control','required' => 'required']) !!}
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('location', 'Job location', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('location', $job->location, array('id' => 'location', 'class' => 'form-control', 'placeholder'   => 'Job location','value' => '')) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('type', 'Job type', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('type', $job->type, array('id' => 'type', 'class' => 'form-control', 'placeholder'   => 'Job type','value' => '')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('salary_range', 'Salary range *', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('salary_range', $job->salary_range, array('id' => 'salary_range', 'class' => 'form-control', 'placeholder'   => 'Salary range','value' => '')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('qualification', 'Job Qualification', array('class'=>'col-sm-2 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('qualification', $job->qualification, array('id' => 'qualification', 'class' => 'form-control', 'placeholder'   => 'Job Qualification', 'value' => '')) !!}
                    </div>
                </div>
            </div>

            @if(isset($vacancy))
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">

                        {!! Form::label('vacancies', 'Job vacancies *', array('class'=>'col-sm-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::select('vacancies', $vacancy, null, ['id' => 'vacancies', 'class' => 'form-control','required' => 'required']) !!}
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($gender))
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">

                        {!! Form::label('gender', 'Gender *', array('class'=>'col-sm-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::select('gender', $gender, null, ['id' => 'gender', 'class' => 'form-control','required' => 'required']) !!}
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($travel))
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">

                        {!! Form::label('travel', 'travel', array('class'=>'col-sm-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::select('travel', $travel, null, ['id' => 'travel', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <div class="col-xs-12" style="margin-bottom: 10px">

                    {!! Form::label('last Date for Applicants', 'last_date', array('class'=>'col-sm-2 control-label')) !!}
                <!-- Delivery date & time field -->
                    <div class="col-sm-6">
                        <div class='input-group apply_by_date'>
                            {!! Form::text('last_date', $job->last_date, ['id' => 'last_date','class' => 'form-control last_date',
                             'style' => 'border-radius: 0px']) !!}
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($active))
                <div class="form-group">
                    <div class="col-xs-12" style="margin-bottom: 10px">

                        {!! Form::label('active', 'Active', array('class'=>'col-sm-2 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::select('active', $active, null, ['id' => 'active', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            @endif

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2" style="margin-bottom: 10px">
                    {!! Form::button('Update', array('class' => 'btn btn-primary','type' => 'submit')) !!}
                    <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('footer_scripts')
    <script>

        $('.last_date').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
        });

        $('textarea .description').ckeditor();
        $('textarea .specification').ckeditor();
    </script>

@stop