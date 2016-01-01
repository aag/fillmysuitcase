@extends('layouts.app')

@section('content')

<div class="container main-container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h1 class="form-page-heading">Create Account</h1>
        </div>
    </div>
 
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <form class="user-form" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label class="control-label">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label">E-Mail Address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="control-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                    
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Create Account</button>

                <div class="privacy-message">We will never sell or give away your email address.</div>
            </form>
        </div>

    </div>
</div>

@stop

