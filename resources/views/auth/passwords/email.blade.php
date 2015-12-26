@extends('layouts.app')

@section('content')
<div class="container-fluid main-container">
    @if (Session::has('status'))
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="page-errors alert alert-success">
                <h4>Email Sent</h4>
                <p>{!! trans(Session::get('status')) !!}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h1 class="form-page-heading">Reset Password</h1>
        </div>
    </div>
 
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            {!! Form::open(array('url' => '/password/email', 'class' => 'user-form')) !!}
            {!! Form::token() !!}

            {!! Form::label('email', 'Email Address') !!}
            {!! Form::text('email', '', array('class' => 'input-block-level')) !!}

            {!! Form::submit('Send Email', array('class' => 'btn btn-primary btn-lg')) !!}

            {!! Form::close() !!}
        </div>

    </div>
</div>
@endsection
