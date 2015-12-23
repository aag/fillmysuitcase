@extends('layouts.app')

@section('content')

<div class="container main-container">
    <div class="row">

        @if (Session::has('success'))
            <div class="col-sm-6 col-sm-offset-3">
                <div class="page-errors alert alert-success">
                    <p>{!! trans(Session::get('success')) !!}</p>
                </div>
            </div>
        @endif

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            {!! Form::open(array('url' => '/auth/login', 'class' => 'user-form')) !!}
            {!! Form::token() !!}

            <h1 class="form-signin-heading">Log In</h1>

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
                Don't have an account yet?  <a href="/auth/register">Create Account</a>
            </div>

            <div class="create-account-message">
                Forgot your password?  <a href="/password/email">Send Reminder</a>
            </div>

            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop

