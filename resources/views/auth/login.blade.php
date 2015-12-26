@extends('layouts.app')

@section('content')

<div class="container main-container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h1 class="form-page-heading">Log In</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            {!! Form::open(array('url' => '/login', 'class' => 'user-form')) !!}
            {!! Form::token() !!}


            {!! Form::label('email', 'Email Address') !!}
            {!! Form::text('email', '', array('class' => 'input-block-level')) !!}

            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', array('class' => 'input-block-level')) !!}

            <div class="remember-me-holder">
                <label class="checkbox">
                    {!! Form::checkbox('remember', true) !!} Remember me
                </label>
            </div>

            {!! Form::submit('Log In', array('class' => 'btn btn-primary btn-lg')) !!}

            <div class="create-account-message">
                Don't have an account yet?  <a href="/register">Create Account</a>
            </div>

            <div class="create-account-message">
                Forgot your password?  <a href="/password/reset">Send Reminder</a>
            </div>

            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop

