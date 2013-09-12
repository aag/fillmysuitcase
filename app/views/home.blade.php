@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1>Pack exactly what you need</h1>
    </div>
    <div>
        <p>
            Have you ever gone on a trip and forgotten something important? Maybe
            you have the opposite problem and pack too much. The problem is that
            every time you pack for a trip, you have to start over from the
            beginning and remember what to bring. It's hard to remember what
            you packed last time, so you pack too little or too much.
        </p>
        <p>
            Fill My Suitcase is a packing list that you use every time you pack.
            If you forget something on this trip, add it to your list and you'll
            never forget it again. Did you take something and not use it? Take
            it off of your list and never pack it again.
        </p>
    </div>
    <div class="list-link">
        <h3><a href="{{ URL::route('listpage') }}">Go to your packing list</a></h3>
    </div>
@stop

