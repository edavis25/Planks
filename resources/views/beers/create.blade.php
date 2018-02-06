@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Create New Beer</h1>

@endsection


@section('admin-content')

    {{-- Include the dish form partial--}}
    @include('partials.beer-form')

@endsection
