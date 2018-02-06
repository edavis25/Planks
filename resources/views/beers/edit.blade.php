@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Editing: {{ $beer->name }}</h1>

@endsection


@section('admin-content')

    {{-- Include the beer form partial--}}
    @include('partials.beer-form')

@endsection
