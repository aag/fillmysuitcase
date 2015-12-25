@extends('layouts.app')

@section('content')

<div class="container main-container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            {!! Form::open(array('url' => '/register', 'class' => 'user-form')) !!}
            {!! Form::token() !!}

            <h1 class="form-signin-heading">Create Account</h1>
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', '', array('class' => 'input-block-level')) !!}

            {!! Form::label('email', 'Email Address') !!}
            {!! Form::text('email', '', array('class' => 'input-block-level')) !!}

            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', array('class' => 'input-block-level')) !!}

            {!! Form::label('password_confirmation', 'Confirm Password') !!}
            {!! Form::password('password_confirmation', array('class' => 'input-block-level')) !!}

            {!! Form::submit('Create Account', array('class' => 'btn btn-primary btn-lg')) !!}

            <div class="privacy-message">We will never sell or give away your email address.</div>

            {!! Form::close() !!}
        </div>

    </div>
</div>

@stop
