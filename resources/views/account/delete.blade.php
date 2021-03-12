@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <h1 class="form-page-heading">Delete Account</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-xl-6">
            <p>Are you sure? Deleting your account permanently removes your login
                information and packing list.</p>

            <p>To delete your account, enter your password and click the delete
                button.</p>

            <form class="user-form" role="form" method="POST" action="{{ url('/account/delete') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" dusk="password-input">
                    
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-danger btn-lg" dusk="delete-account-button">Delete My Account</button>

            </form>

        </div>

    </div>
</div>

@stop

