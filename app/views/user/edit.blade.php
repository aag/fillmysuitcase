@extends('layouts.app')

@section('content')

    {{ Form::model($user, array('route' => 'user.update', 'class' => 'create-user-form')) }}
    {{ Form::token() }}

    <h2 class="form-signin-heading">Edit Account Info</h2>
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', null, array('class' => 'input-block-level')) }}

    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', null, array('class' => 'input-block-level')) }}

    {{ Form::label('password', 'Change Password') }}
    {{ Form::password('password', array('class' => 'input-block-level')) }}

    {{ Form::label('password_confirmation', 'Confirm New Password') }}
    {{ Form::password('password_confirmation', array('class' => 'input-block-level')) }}

    {{ Form::submit('Save', array('class' => 'btn btn-primary btn-large')) }}

    {{ Form::close() }}

@stop

