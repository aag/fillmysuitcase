@extends('layouts.app')

@section('content')

<div class="container main-container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h1 class="form-page-heading">Reset Password</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            {!! Form::open(array('url' => '/password/reset', 'class' => 'user-form')) !!}
            {!! Form::hidden('token', $token) !!}

            {!! Form::label('email', 'Email Address') !!}
            {!! Form::text('email', '', array('class' => 'input-block-level')) !!}

            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', array('class' => 'input-block-level')) !!}

            {!! Form::label('password_confirmation', 'Confirm Password') !!}
            {!! Form::password('password_confirmation', array('class' => 'input-block-level')) !!}

            {!! Form::submit('Reset Password', array('class' => 'btn btn-primary btn-lg')) !!}

            {!! Form::close() !!}

        </div>

    </div>
</div>

@endsection
