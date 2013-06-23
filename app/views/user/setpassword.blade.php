@extends('layouts.app')

@section('content')

@if (Session::has('error'))
    <div class="page-errors alert alert-error">
        <h4>Error</h4>
        <p>{{ trans(Session::get('reason')) }}</p>
    </div>
@endif

@if (!Session::has('success'))

    {{ Form::open(array('action' => array('UserController@setPassword', $token), 'class' => 'create-user-form')) }}
    {{ Form::hidden('token', $token) }}

    <h2 class="form-signin-heading">Reset Password</h2>
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', '', array('class' => 'input-block-level')) }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', array('class' => 'input-block-level')) }}

    {{ Form::label('password_confirmation', 'Confirm Password') }}
    {{ Form::password('password_confirmation', array('class' => 'input-block-level')) }}

    {{ Form::submit('Save Password', array('class' => 'btn btn-primary btn-large')) }}

    {{ Form::close() }}

@endif

@stop

