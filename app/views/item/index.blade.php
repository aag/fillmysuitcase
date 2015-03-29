@extends('layouts.app')

@section('content')

<div class="container-fluid main-container">

    <h2>Your Packing List</h2>

    <div id="list-container">
        @include('item._list')
    </div>

</div>

@stop


