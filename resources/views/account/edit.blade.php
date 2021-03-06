@extends('layouts.app')

@section('page-type')account-edit @stop

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <h1 class="form-page-heading">Edit Account Info</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Edit Username or Email Address</h2>
                </div>
                <div class="card-body">
                    <form class="user-form" role="form" method="POST" action="{{ url('/account/editinfo') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ $username }}">

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('info_current_password') ? ' has-error' : '' }}">
                            <label for="id_current_password" class="control-label">Current Password</label>
                            <input id="id_current_password" type="password" class="form-control" name="info_current_password" value="">
                            
                            @if ($errors->has('info_current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('info_current_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>

                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Change Password</h2>
                </div>
                <div class="card-body">
                    <form class="user-form" role="form" method="POST" action="{{ url('/account/changepassword') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('password_current_password') ? ' has-error' : '' }}">
                            <label for="password_current_password" class="control-label">Current Password</label>
                            <input id="password_current_password" type="password" class="form-control" name="password_current_password" value="">
                            
                            @if ($errors->has('password_current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_current_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">New Password</label>
                            <input id="password" type="password" class="form-control" name="password" value="">
                            
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirmation" class="control-label">Confirm New Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="">
                            
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>

                    </form>
                </div>
            </div>

            <div class="delete-account-link-holder">
                <a href="{!! URL::route('account.getdelete') !!}" class="text-danger" dusk="delete-account-link">Delete Account</a>
            </div>

        </div>

    </div>
</div>

@stop

