@extends('layouts.app')

@section('content')

@if (Session::has('status'))
    <div class="page-errors alert alert-success">
        <h4>Email Sent</h4>
        <p>{{ trans(Session::get('status')) }}</p>
    </div>
@elseif (Session::has('error'))
    <div class="page-errors alert alert-error">
        <h4>Error</h4>
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

@if (!Session::has('success'))

    {{ Form::open(array('action' => 'RemindersController@postRemind', 'class' => 'user-form')) }}
    {{ Form::token() }}

    <h2 class="form-signin-heading">Reset Password</h2>
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', '', array('class' => 'input-block-level')) }}

    {{ Form::submit('Send Email', array('class' => 'btn btn-primary btn-large')) }}

    {{ Form::close() }}

@endif

@stop

