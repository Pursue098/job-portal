@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Client area: apply for job
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
        <div class="col-md-12">
            <div class="col-xs-12">
                <h3 style="margin-left: 300px; margin-bottom: 30px;">Jobs and its Applications</h3>
            </div>
            @forelse($jobsByUser as $job)

                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Job Title:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->title }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Job Description:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->description }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Experience :
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->experience }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Location:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->location }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Job Type:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->type }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Salary range:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->salary_range }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Qualification:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->qualification }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Gender:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->gender }}
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Travel:
                    </div>
                    <div class="col-xs-9" style="color: rgba(55, 67, 78, 0.74)">
                        {{ $job->travel }}
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
                                <th>First name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Address</th>
                                <th>Apply date</th>
                                <th>CV</th>
                                <th>Status</th>
                                <th>Operation</th>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($job->user as $indexKey => $applicant)
                                <tr style="color: #3e4554; font-size: 13px; ">
                                    @if(isset($applicant->user_profile[0]->first_name))
                                        <td>{{ $applicant->user_profile[0]->first_name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($applicant->user_profile[0]->last_name))
                                        <td>{{ $applicant->user_profile[0]->last_name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($applicant->user_profile[0]->phone))
                                        <td>{{ $applicant->user_profile[0]->phone }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($applicant->email))
                                        <td>{{ $applicant->email }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($applicant->user_profile[0]->city))
                                        <td>{{ $applicant->user_profile[0]->city }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($applicant->user_profile[0]->address))
                                        <td>{{ $applicant->user_profile[0]->address }}</td>
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
                                            @if($applicant->getCv($job->user->first()->pivot->cv_id) !==false)

                                                <a href="{!! URL::route('admin.download-cv', ['id' => $job->user->first()->pivot->cv_id]) !!}">
                                                    <i class="icon-download-alt"> </i> {{$applicant->getCv($job->user->first()->pivot->cv_id)->name}}
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
                                                <a class="cancelApplication" href="{!! URL::route('admin.cancelApplicationByAdmin', ['id' => $job->id]) !!}" >
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
                <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">

            @empty
                <p>No Job Applied</p>
            @endforelse
        </div>

    </div>
@stop
@section('footer_scripts')
    <script>

        $('ul.pagination > li > a').css('tabindex', '-1');


        $(".delete_job").click(function(){

            return confirm("Are you sure to delete this job?");
        });

        $(".cancelApplication").click(function () {

            return confirm("Are you sure to delete this item?");

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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

    </script>
@stop