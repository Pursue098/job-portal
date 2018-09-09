@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: apply for job
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
            @forelse($applicants as $applicant)

                @if(isset($applicant->user_profile[0]->first_name))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            First name:
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->user_profile[0]->first_name }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->user_profile[0]->last_name))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            Last name:
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->user_profile[0]->last_name }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->user_profile[0]->phone))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            Phone# :
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->user_profile[0]->phone }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->email))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            Email:
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->email }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->user_profile[0]->city))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            City:
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->user_profile[0]->city }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->user_profile[0]->state))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            Province:
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->user_profile[0]->state }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->user_profile[0]->address))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            User address:
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->user_profile[0]->address }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->pivot->created_at))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            Job Apply date:
                        </div>
                        <div class="col-xs-9">
                            {{ $applicant->pivot->created_at }}
                        </div>
                    </div>
                @endif
                @if(isset($applicant->id))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            CV:
                        </div>
                        <div class="col-xs-9">
                            @if($applicant->getCv($job->user->first()->pivot->cv_id) !==false)

                                <a href="{!! URL::route('admin.download-cv', ['id' => $job->user->first()->pivot->cv_id]) !!}">
                                    <i class="icon-download-alt"> </i> Download CV
                                </a>
                            @endif

                        </div>
                    </div>
                @endif
                @if(isset($status))

                    <div class="col-xs-12" style="margin-bottom: 10px">
                        <div class="col-xs-3">
                            Operation:
                        </div>
                        <div class="col-xs-2">
                                <div class="form-group">

                                    <select class="form-control status" data-id="{{$job_id}}" id="{{$applicant->id}}" style="border-radius: 0px">
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
                                <span class="text-danger">{!! $errors->first('status') !!}</span>

                        </div>
                    </div>

                    <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">

                @else
                    <p>User did not apply for this job until. Thanx </p>
                @endif

            @empty
                <p>User did not apply for this job until. Thanx</p>
            @endforelse

        </div>
    </div>
@stop
@section('footer_scripts')
    <script>

        $('ul.pagination > li > a').css('tabindex', '-1');

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