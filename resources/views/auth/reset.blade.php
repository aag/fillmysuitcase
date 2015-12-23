@extends('layouts.app')

@section('content')

<div class="container main-container">
    <div class="row">

        @if (Session::has('error'))
            <div class="col-sm-6 col-sm-offset-3">
                <div class="page-errors alert alert-danger">
                    <h4>Error</h4>
                    <p>{!! Session::get('error') !!}</p>
                </div>
            </div>
        @endif

        @if (!Session::has('success'))
            <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                {!! Form::open(array('url' => array('/password/reset', $token), 'class' => 'user-form')) !!}
                {!! Form::hidden('token', $token) !!}

                <h1 class="form-signin-heading">Reset Password</h1>
                {!! Form::label('email', 'Email Address') !!}
                {!! Form::text('email', '', array('class' => 'input-block-level')) !!}

                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', array('class' => 'input-block-level')) !!}

                {!! Form::label('password_confirmation', 'Confirm Password') !!}
                {!! Form::password('password_confirmation', array('class' => 'input-block-level')) !!}

                {!! Form::submit('Reset Password', array('class' => 'btn btn-primary btn-lg')) !!}

                {!! Form::close() !!}

            </div>
        @endif

    </div>
</div>

@endsection
