@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Events list
@stop

@section('content')
    <div class="row" style="margin-right: 20px;!important;">
        <div class="col-md-12">
            <div class="col-md-12">
                {{--            @include('admin.events.search')--}}
            </div>
            <div class="col-md-12" style="margin-right: 20px;!important;">
                {{-- print messages --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                    <div class="alert alert-success">{!! $message !!}</div>
                @endif
                {{-- print errors --}}
                @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{!! $error !!}</div>
                    @endforeach
                @endif
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

                        @if(isset($event))

                            <div class="col-xs-12">
                                <div class="col-xs-3">
                                    Event ID:
                                </div>
                                <div class="col-xs-9">
                                    {{ $event->id }}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-xs-3">
                                    Event Name:
                                </div>
                                <div class="col-xs-9">
                                    {{ $event->name }}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-xs-3">
                                    Event Description:
                                </div>
                                <div class="col-xs-9">
                                    {{ $event->description }}
                                </div>
                            </div>
                        @endif
                        @if(isset($user) && count($user) > 0)

{{--                            {{dd($user[0]->user_profile[0]->first_name)}}--}}
                            @if(isset($user[0]->user_profile))
                                <div class="col-xs-12">
                                    <div class="col-xs-12">
                                        User Details:
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="col-xs-3">
                                        First Name:
                                    </div>
                                    <div class="col-xs-9">
                                        {{ $user[0]->user_profile[0]->first_name }}
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-xs-3">
                                        Last Name:
                                    </div>
                                    <div class="col-xs-9">
                                        {{ $user[0]->user_profile[0]->last_name }}
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-xs-3">
                                        City:
                                    </div>
                                    <div class="col-xs-9">
                                        {{ $user[0]->user_profile[0]->city }}
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-xs-3">
                                        Country:
                                    </div>
                                    <div class="col-xs-9">
                                        {{ $user[0]->user_profile[0]->country }}
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="col-xs-3">
                                        Address:
                                    </div>
                                    <div class="col-xs-9">
                                        {{ $user[0]->user_profile[0]->address }}
                                    </div>
                                </div>
                                <a class="btn btn-default" href="{{ route('admin.event.index') }}"
                                   style="margin-top: 20px; margin-left: 20px;">OK</a>

                            @endif
                        @endif
                        <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('footer_scripts')
    <script>

    </script>
@stop
