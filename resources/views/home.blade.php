@extends('layouts.app')

@section('page-type')home @stop

@section('content')
    <div class="jumbotron jumbotron-home">
        <h1 class="impact-text">Pack right for every trip.</h1>
        <h3 class="subtitle">Put your packing list online and never pack too much or too little.</h3>
    </div>
    <div class="shortblurb">
        <h3>What does it do?</h3>
        <p>Most people pack way too much when they travel, forget to bring
            essential things, or both. FillMySuitcase helps you pack
            everything you need, but nothing you don't. It's an online packing
            list that you use every time you travel.
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-2 col-sm-4"></div>
            <div class="col-xs-8 col-sm-4">
                <a class="btn btn-primary btn-lg btn-block" href="/login">Get started</a>
            </div>
            <div class="col-xs-2 col-sm-4"></div>
        </div>
    </div>
@stop

