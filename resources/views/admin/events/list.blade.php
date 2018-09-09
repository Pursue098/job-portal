
@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Event list
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
            </div>
            <div class="col-md-12">
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

                @include('admin.events.index')
            </div>
        </div>
    </div>
@stop
