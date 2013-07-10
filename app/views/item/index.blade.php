@extends('layouts.app')

@section('content')

    <h2>Your Packing List</h2>

    <ul>
        @foreach ($items as $item)
        <li>{{ $item->name }}</li>
        @endforeach
    </ul>

@stop


