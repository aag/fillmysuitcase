@extends('layouts.app')

@section('content')

<div class="container main-container">

    <h1>Your Packing List</h1>

    <div id="list-container">
        @include('item._list')
    </div>

</div>

@stop


