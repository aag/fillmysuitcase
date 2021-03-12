@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="list-page-title">Your Packing List</h1>

    <div id="list-container" class="container">
        @include('item._list')
    </div>

</div>

@stop


