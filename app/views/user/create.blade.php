@extends('layouts.app')

@section('content')

    {{ Form::open(array('action' => 'UserController@store', 'class' => 'create-user-form')) }}
    {{ Form::token() }}

    <h2 class="form-signin-heading">Create Account</h2>
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', '', array('class' => 'input-block-level')) }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', array('class' => 'input-block-level')) }}

    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', '', array('class' => 'input-block-level')) }}

    {{ Form::submit('Create Account', array('class' => 'btn btn-primary btn-large')) }}

    {{ Form::close() }}

@stop

