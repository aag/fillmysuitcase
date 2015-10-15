@extends('layouts.app')

@section('content')

<div class="container-fluid main-container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
 
            {{ Form::model($user, array('route' => 'user.update', 'class' => 'user-form')) }}
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

            {{ Form::submit('Save', array('class' => 'btn btn-primary btn-lg')) }}

            <div class="delete-account-link-holder">
                <a href="{{ URL::route('user.delete') }}">Delete Account</a>
            </div>

            {{ Form::close() }}
        </div>

    </div>
</div>

@stop

