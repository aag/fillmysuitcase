@extends('layouts.app')

@section('page-type')account-edit @stop

@section('content')

<div class="container main-container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h1>Edit Account Info</h1>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Edit Username or Email Address</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($user, array('route' => 'account.posteditinfo', 'class' => 'user-form')) !!}
                    {!! Form::token() !!}

                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', null, array('class' => 'input-block-level')) !!}

                    {!! Form::label('email', 'Email Address') !!}
                    {!! Form::text('email', null, array('class' => 'input-block-level')) !!}

                    {!! Form::label('password', 'Current Password') !!}
                    {!! Form::password('password', array('class' => 'input-block-level')) !!}

                    {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

                    {!! Form::close() !!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Change Password</h2>
                </div>
                <div class="panel-body">
                    {!! Form::model($user, array('route' => 'account.postchangepassword', 'class' => 'user-form')) !!}
                    {!! Form::token() !!}

                    {!! Form::label('current_password', 'Current Password') !!}
                    {!! Form::password('current_password', array('class' => 'input-block-level')) !!}

                    {!! Form::label('password', 'New Password') !!}
                    {!! Form::password('password', array('class' => 'input-block-level')) !!}

                    {!! Form::label('password_confirmation', 'Confirm New Password') !!}
                    {!! Form::password('password_confirmation', array('class' => 'input-block-level')) !!}

                    {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

                    {!! Form::close() !!}
                </div>
            </div>

            <div class="delete-account-link-holder">
                <a href="{!! URL::route('account.getdelete') !!}" class="text-danger">Delete Account</a>
            </div>

        </div>

    </div>
</div>

@stop

