@extends('layouts.app')

@section('content')
<div class="container-fluid main-container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">
            @if (Session::has('status'))
                <div class="page-errors alert alert-success">
                    <h4>Email Sent</h4>
                    <p>{!! trans(Session::get('status')) !!}</p>
                </div>
            @elseif (Session::has('error'))
                <div class="page-errors alert alert-danger">
                    <h4>Error</h4>
                    <p>{!! Session::get('error') !!}</p>
                </div>
            @endif
        </div>

        @if (!Session::has('success'))
            <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                {!! Form::open(array('url' => '/password/email', 'class' => 'user-form')) !!}
                {!! Form::token() !!}

                <h1 class="form-signin-heading">Reset Password</h1>
                {!! Form::label('email', 'Email Address') !!}
                {!! Form::text('email', '', array('class' => 'input-block-level')) !!}

                {!! Form::submit('Send Email', array('class' => 'btn btn-primary btn-lg')) !!}

                {!! Form::close() !!}
            </div>
        @endif

    </div>
</div>
@endsection
