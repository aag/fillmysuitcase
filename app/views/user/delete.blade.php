@extends('layouts.app')

@section('content')

    {{ Form::model($user, array('route' => 'user.dodelete', 'class' => 'user-form')) }}
    {{ Form::token() }}

    <h2 class="form-signin-heading">Delete Account</h2>

    <p>Are you sure? Deleting your account permanently removes your login
        information and packing list.</p>

    <p>To delete your account, enter your password and click the delete
        button.</p>

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', array('class' => 'input-block-level')) }}

    {{ Form::submit('Delete My Account', array('class' => 'btn btn-danger btn-lg')) }}

    {{ Form::close() }}

@stop

