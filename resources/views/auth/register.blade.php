@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <h1 class="form-page-heading">Create Account</h1>
        </div>
    </div>
 
    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-xl-6">
            <form class="user-form" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="control-label">Username</label>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" dusk="username-input">

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" dusk="email-input">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" dusk="password-input">
                    
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation" class="control-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" dusk="password-confirm-input">
                    
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-lg" dusk="submit-button">Create Account</button>

                <div class="privacy-message">We will never sell or give away your email address.</div>
            </form>
        </div>

    </div>
</div>

@stop

