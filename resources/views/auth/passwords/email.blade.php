@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('status'))
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <div class="page-errors alert alert-success">
                <h4>Email Sent</h4>
                <p>{!! trans(Session::get('status')) !!}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <h1 class="form-page-heading">Reset Password</h1>
        </div>
    </div>
 
    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-xl-6">
            <form class="user-form" role="form" method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Send Email</button>
            </form>
        </div>

    </div>
</div>
@endsection
