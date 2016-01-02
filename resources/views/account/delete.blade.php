@extends('layouts.app')

@section('content')

<div class="container-fluid main-container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h1 class="form-page-heading">Delete Account</h1>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <p>Are you sure? Deleting your account permanently removes your login
                information and packing list.</p>

            <p>To delete your account, enter your password and click the delete
                button.</p>

            <form class="user-form" role="form" method="POST" action="{{ url('/account/delete') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-danger btn-lg">Delete My Account</button>

            </form>

        </div>

    </div>
</div>

@stop

