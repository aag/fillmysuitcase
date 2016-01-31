@extends('layouts.app')

@section('page-type')home @stop

@section('content')
    <div class="jumbotron jumbotron-home">
        <h1 class="impact-text">Pack right for every trip.</h1>
        <h3 class="subtitle">Put your packing list online and never pack too much or too little.</h3>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
                <div class="homepage-blurb">
                    <h3>What is FillMySuitcase?</h3>
                    <p>Most people pack way too much when they travel, forget to bring
                        essential things, or both. FillMySuitcase helps you pack
                        everything you need, but nothing you don't. It's an online packing
                        list that you use every time you travel.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
            @if(Auth::guest())
                <a class="btn btn-primary btn-lg btn-block" href="/login">Get started</a>
            @else
                <a class="btn btn-primary btn-lg btn-block" href="/list">View Your List</a>
            @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
                <div class="homepage-blurb">
                    <h3>How does it work?</h3>
                    <p>FillMySuitcase is designed to be used with a particular method of
                        packing. With this method, you reuse the same packing list for
                        every trip you take.
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop

