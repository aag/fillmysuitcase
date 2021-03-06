@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <h1 class="form-page-heading">Log In</h1>
        </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-xl-6">
            <form class="user-form" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="email">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label" for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                    
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="remember-me-holder">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Log In</button>

                <div class="create-account-message">
                    Don't have an account yet?  <a href="/register" dusk="register-link">Create Account</a>
                </div>

                <div class="create-account-message">
                    Forgot your password?  <a href="/password/reset">Send Reminder</a>
                </div>

            </form>
        </div>

    </div>
</div>
@stop

