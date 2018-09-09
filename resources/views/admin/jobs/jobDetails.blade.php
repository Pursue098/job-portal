@extends('laravel-authentication-acl::admin.layouts.base-2cols')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title')
    Admin area: edit job
@stop


@section('content')
    <div class="row">
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
        <div class="col-md-12">
            <div class="col-xs-12">
                <div class="col-xs-12">
                    <h3 style="text-align: center">Job's Detail</h3>
                </div>
            </div>
        @if(isset($job) && count($job) > 0)
            <div class="col-xs-12">
                <div class="col-xs-3">
                    Job Title:
                </div>
                <div class="col-xs-9" style="color: #566271">
                    {{ $job->title }}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-3">
                    Job Description:
                </div>
                <div class="col-xs-9" style="color: #566271">
                    {{ strip_tags($job->description) }}
                </div>
            </div>

            @if(isset($experience))
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Experience :
                    </div>
                    <div class="col-xs-9" style="color: #566271">
                        @foreach (array_values($experience) as $index => $value)
                            @if($job->experience == $index)
                                {!! $value !!}
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            @if(isset($vacancy))
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Cacancy :
                    </div>
                    <div class="col-xs-9" style="color: #566271">
                        @foreach (array_values($vacancy) as $index => $value)
                            @if($job->vacancy == $index)
                                {!! $value !!}
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="col-xs-12">
                <div class="col-xs-3">
                    Location:
                </div>
                <div class="col-xs-9" style="color: #566271">
                    {{ $job->location }}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-3">
                    Job Type:
                </div>
                <div class="col-xs-9 " style="color: #566271">
                    {{ $job->type }}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-3">
                    Salary range:
                </div>
                <div class="col-xs-9" style="color: #566271">
                    {{ $job->salary_range }}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-3">
                    Qualification:
                </div>
                <div class="col-xs-9" style="color: #566271">
                    {{ $job->qualification }}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-xs-3">
                    last Date:
                </div>
                <div class="col-xs-9" style="color: #566271">
                    {{ $job->last_date->toFormattedDateString() }}
                </div>
            </div>

            @if(isset($gender))
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Gender:
                    </div>
                    <div class="col-xs-9" style="color: #566271">
                        @foreach (array_values($gender) as $index => $value)
                            @if($job->gender == $index)
                                {!! $value !!}
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            @if(isset($travel))
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Travel:
                    </div>
                    <div class="col-xs-9" style="color: #566271">
                        @foreach (array_values($travel) as $index => $value)
                            @if($job->travel == $index)
                                {!! $value !!}
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
                @if(isset($active))
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Active:
                    </div>
                    <div class="col-xs-9" style="color: #566271">
                        @foreach (array_values($active) as $index => $value)
                            @if($job->active == $index)

                                {!! $value !!}
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="col-xs-12">
                <div class="col-xs-3">
                    Total applications:
                </div>
                <div class="col-xs-9" style="color: #566271">
                    {{ count($job->user) }}
                </div>
            </div>

            <div class="col-xs-12">
                @if( $job->id)
                    <div class="col-xs-8" style="margin-top: 20px;">
                        <div class="col-xs-1">
                            <a href="{!! URL::route('admin.jobs.edit', ['id' => $job->id]) !!}">
                                <i class="fa fa-pencil-square-o fa-2x"></i>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            {!! Form::model($job, [ 'url' => URL::route('admin.jobs.destroy', ['id' => $job->id])] )  !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {!! Form::submit('Delete', array("class"=>"btn btn-info delete_job")) !!}
                            {!! Form::close() !!}

                        </div>
                        <div class="col-xs-1" style="margin-top:8px;">
                            @if($job->active === 1)
                                <a href="{!! URL::route('admin.job-status', ['id' => $job->id]) !!}">
                                    Deactivate
                                </a>
                            @elseif($job->active === 0)
                                <a href="{!! URL::route('admin.job-status', ['id' => $job->id]) !!}">
                                    Activate
                                </a>
                            @endif

                        </div>
                    </div>
                @else
                    <i class="fa fa-times fa-2x light-blue"></i>
                    <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                @endif
            </div>
            <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">

            @if(isset($job->user) && count($job->user) > 0)
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <h3 class="application_heading" style="text-align: center">Job's Applications</h3>
                    </div>
                </div>
                <div class="row">
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
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissable flat">
                                <a href="javascript:void(0); " class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">

                        <div class="col-sm-12">
                            <div class="alert alert-success fade in" hidden>Job status is changed!</div>
                            <div class="alert alert-danger fade in" hidden>Job status is not changed!</div>

                        </div>
                        <div class="col-md-12">

                                <table class="table table-bordered"  style="margin-top: 20px">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Apply date</th>
                                        <th>CV</th>
                                        <th>Status</th>
                                        <th>Operation</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($job->user as $indexKey => $applicant)
                                            <tr style="color: #3e4554; font-size: 13px;">
                                                @if(isset($applicant->user_profile[0]->first_name))
                                                    <td>{{ $applicant->user_profile[0]->first_name }}</td>
                                                @else
                                                    <td></td>
                                                @endif

                                                @if(isset($applicant->email))
                                                    <td>{{ $applicant->email }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if(isset($applicant->pivot->created_at))
                                                    <td>{{ $applicant->pivot->created_at }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if(isset($job->user->first()->pivot->cv_id))
                                                    <td>
                                                        @if($applicant->getCv($job->id, $applicant->id) !==false)

                                                            <a href="{!! URL::route('admin.download-cv', ['id' => $applicant->getCv($job->id, $applicant->id)->id]) !!}">
                                                                <i class="icon-download-alt"> </i> {{$applicant->getCv($job->id, $applicant->id)->name}}
                                                            </a>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if(isset($status) && isset($job->id))
                                                    <td>
                                                        <div class="form-group">

                                                            <select class="form-control status" data-id="{{$job->id}}" id="{{$applicant->id}}" style="border-radius: 0px">
                                                                @if(isset($status))
                                                                    @foreach ($status as $stat)
                                                                        @if(isset($applicant->pivot->status))
                                                                            @if ($stat['key'] == $applicant->pivot->status)
                                                                                <option selected value="{{ $stat['key'] }}">{{ $stat['value'] }}</option>
                                                                            @else
                                                                                <option value="{{ $stat['key'] }}">{{ $stat['value'] }}</option>
                                                                            @endif
                                                                        @else
                                                                            @if ($stat['key'] == 0)
                                                                                <option selected value="{{ $stat['key'] }}">{{ $stat['value'] }}</option>
                                                                            @else
                                                                                <option value="{{ $stat['key'] }}">{{ $stat['value'] }}</option>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if(isset($job->user->first()->pivot->cv_id))
                                                    <td>
                                                        <a class="cancelApplication" href="{!! URL::route('admin.cancelApplicationByAdmin', ['id'=>$job->id, 'applicant'=>$applicant->id]) !!}" >
                                                            Cancel application
                                                        </a>
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                            </tr>

                                        @empty
                                            <p>No application exist for this job until. Thanx</p>
                                        @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
            @endif

        @else
            <span> </span>
        @endif

    </div>
    </div>
@stop

@section('footer_scripts')
        <script>

            (function($) {

                $('ul.pagination > li > a').css('tabindex', '-1');


                $(".delete_job").click(function(){

                    return confirm("Are you sure to delete this job?");
                });

                $(".cancelApplication").click(function () {

                    return confirm("Are you sure to delete this item?");

                });


                $('.status').change(function(){

                    var job_id = $(this).attr('data-id');
                    var user_id = $(this).attr('id');
                    var status= $('#'+user_id).val();

                    var data = {'user_id':user_id, 'status':status, 'job_id':job_id };

                    $.ajax({
                        type: "GET",
                        url: '{{env('APP_URL')}}'+'admin/applications/changeStatus',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:data,
                        success: function(data) {

                            console.log(data)
                            if(data.status == 'success'){

                                $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                                    $(".alert-success").slideUp(500);
                                });

                            }else{

                                $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
                                    $(".alert-danger").slideUp(500);
                                });
                            }
                        },
                        error: function(data) {
                            $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
                                $(".alert-danger").slideUp(500);
                            });
                        }

                    },"json");

                    return;

                });
            })(jQuery);
    </script>
    @stop