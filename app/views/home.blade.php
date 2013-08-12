@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1>Remember to pack everything</h1>
    </div>
    <div class="list-link">
        <h3><a href="{{ URL::route('itemindex') }}">Go to my packing list</a></h3>
    </div>
@stop

