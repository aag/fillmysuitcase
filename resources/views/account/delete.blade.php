@extends('layouts.app')

@section('content')

<div class="container-fluid main-container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <h1 class="form-signin-heading">Delete Account</h1>

            <p>Are you sure? Deleting your account permanently removes your login
                information and packing list.</p>

            <p>To delete your account, enter your password and click the delete
                button.</p>

            {!! Form::model($user, array('route' => 'account.postdelete', 'class' => 'user-form')) !!}
            {!! Form::token() !!}

            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', array('class' => 'input-block-level')) !!}

            {!! Form::submit('Delete My Account', array('class' => 'btn btn-danger btn-lg')) !!}

            {!! Form::close() !!}

        </div>

    </div>
</div>

@stop

