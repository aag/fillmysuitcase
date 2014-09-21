@extends('layouts.app')

@section('content')

@if (Session::has('error'))
    <div class="page-errors alert alert-danger">
        <h4>Error</h4>
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

@if (!Session::has('success'))

    {{ Form::open(array('action' => array('RemindersController@postReset', $token), 'class' => 'user-form')) }}
    {{ Form::hidden('token', $token) }}

    <h2 class="form-signin-heading">Reset Password</h2>
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', '', array('class' => 'input-block-level')) }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', array('class' => 'input-block-level')) }}

    {{ Form::label('password_confirmation', 'Confirm Password') }}
    {{ Form::password('password_confirmation', array('class' => 'input-block-level')) }}

    {{ Form::submit('Reset Password', array('class' => 'btn btn-primary btn-lg')) }}

    {{ Form::close() }}

@endif

@stop

