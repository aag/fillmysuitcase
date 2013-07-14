@extends('layouts.app')

@section('content')

    <h2>Your Packing List</h2>

    <div id="list-container">
        @include('item._list')
    </div>

@stop


