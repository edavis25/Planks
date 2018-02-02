@extends('layouts.admin')

@section('admin-header')
    <a class="btn btn-info text-white mb-2" href="{{ url('/dishes') }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Editing: {{ $dish->name }}</h1>

@endsection


@section('admin-content')

    {{-- Include the dish form partial--}}
    @include('partials.dish-form')

@endsection
