@extends('layouts.app')

@section('content')

    {{ Form::open(array('action' => 'UserController@login', 'class' => 'create-user-form')) }}
    {{ Form::token() }}

    <h2 class="form-signin-heading">Log In</h2>
    {{ Form::label('username', 'Username or Email Address') }}
    {{ Form::text('username', '', array('class' => 'input-block-level')) }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', array('class' => 'input-block-level')) }}

    <label class="checkbox">
        {{ Form::checkbox('remember', true) }} Remember me
    </label>

    {{ Form::submit('Log In', array('class' => 'btn btn-primary btn-large')) }}

    <div class="create-account-message">
        Don't have an account yet?  <a href="{{ URL::route('createuser') }}">Create Account</a>
    </div>

    <div class="create-account-message">
        Forgot your password?  <a href="{{ URL::route('passwordreset') }}">Send Reminder</a>
    </div>

    {{ Form::close() }}
@stop

