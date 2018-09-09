@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Order list
@stop

@section('content')
<div class="row" style="margin-right: 20px;!important;">
    <div class="col-md-12">
        <div class="col-md-12">
{{--            @include('admin.orders.search')--}}
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

             @include('admin.jobs.index')
        </div>
    </div>
</div>
@stop

@section('footer_scripts')

@stop
