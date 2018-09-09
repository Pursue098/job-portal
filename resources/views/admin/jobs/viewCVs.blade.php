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
            {{--            {{dd($jobs)}}--}}

            @if(isset($jobsByUser) && count($jobsByUser) > 0)
                @forelse($jobsByUser as $job)

                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Job Title:
                        </div>
                        <div class="col-xs-9">
                            {{ $job->title }}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Job Description:
                        </div>
                        <div class="col-xs-9">
                            {{ $job->description }}
                        </div>
                    </div>
                    @if(count($user) > 0)
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                First name :
                            </div>
                            <div class="col-xs-9">
                                @if(isset($user->user_profile[0]))
                                    {{ $user->user_profile[0]->first_name }}
                                @endif
                            </div>
                        </div>
                    @endif
                    @if(count($user) > 0)
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                Last name :
                            </div>
                            <div class="col-xs-9">
                                @if(isset($user->user_profile[0]))
                                    {{ $user->user_profile[0]->last_name }}
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            CV file :
                        </div>
                        <div class="col-xs-9">
                            <a href="{!! URL::route('admin.download-cv', ['id' => $job->id]) !!}">
                                <i class="icon-download-alt"> </i> {{ $job->pivot->cv_file }}
                            </a>
                        </div>
                    </div>

                    <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">

                @empty
                    <p>No Job Applied</p>
                @endforelse
            @endif

        </div>

    </div>
@stop
