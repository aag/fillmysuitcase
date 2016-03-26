@extends('layouts.app')

@push('meta-tags')
    <meta name="description" content="Fill My Suitcase is a website that helps you pack your luggage each time you travel.">
@endpush

@section('page-type')home @stop

@section('content')
    <div class="jumbotron jumbotron-home">
        <h1 class="impact-text">Pack right for every trip.</h1>
        <p class="subtitle">Put your packing list online and never pack too much or too little.</p>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
                <div class="homepage-blurb">
                    <h2>What is Fill My Suitcase?</h2>
                    <p>Most people pack way too much when they travel, forget to bring
                        essential things, or both. Fill My Suitcase helps you pack
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
                    <h2>How does it work?</h2>
                    <p>Fill My Suitcase is designed to be used with a particular method of
                        packing, called the <strong>One List, Two Pass</strong> method.
                        One List refers to using the same packing list for
                        every trip you take, for the rest of your life. Two Pass
                        refers to going through the list twice each time you pack.
                    </p>
                </div>
                <div class="long-explanation">
                    <h3>The One List, Two Pass method has three simple rules:</h3>
                    <ol>
                        <li>
                            <h4>
                                Put everything on the list as soon as you think
                                of it.
                            </h4>
                            <p>
                                In the days and weeks before your trip, you'll be thinking
                                of what you'll do on the trip and what you need while
                                you're there. Maybe you're going to the ocean and want to
                                bring your snorkel or you're going to Norway in the winter
                                and you need to bring your heavy coat. No matter what it is,
                                you immediately put it on the one packing list that you
                                always use for every trip. The first time you
                                travel with this list, you'll probably sit down once and add
                                all the things you bring on every trip like shirts, socks, your
                                wallet, and shoes.
                            </p>
                        </li>
                        <li>
                            <h4>
                                When it's time to pack your bags, do a first pass over the
                                list to clean up things you don't need on this trip.
                            </h4>
                            <p>
                                At this stage, you read every item on the list and decide
                                if you'll need it on the trip. When you get to an item
                                that you <strong>will</strong> need on the trip, leave it
                                alone and move on to the next item. When you get to an item
                                that you <strong>won't</strong> need on the trip, you do one
                                of two things:
                            </p>
                            <ul>
                                <li>
                                    <strong>Check it off.</strong> Do this for items that you
                                    don't need on this trip, but you will need on future trips.
                                    For example, if you're going to Jamaica in the summer, you
                                    won't need your heavy coat, but you almost certainly will
                                    need it in the future. So, you just check it off as if
                                    you had already packed it.
                                </li>
                                <li>
                                    <strong>Delete it from the list.</strong> Do this for items
                                    that you'll never need to pack again. Maybe the last time
                                    you took a trip you were going to a wedding, so you have the
                                    item "Wedding present for Sarah and James". This was a
                                    one-off item that you won't need on any future trip, so
                                    you can go ahead and remove it from the list.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <h4>
                                Pack everything left on the list.
                            </h4>
                            <p>
                                Now everything that is on your list is something you need
                                to bring on your trip. Get each item and check it off the list.
                                You can actually put each item in your bag before you check
                                it off, or just gather everything in one place and pack it all
                                once it's all together. The latter has the advantage of making
                                it a little easier to plan where everything will go.
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@stop

