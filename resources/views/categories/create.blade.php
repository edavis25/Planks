@extends('layouts.admin')

@section('admin-header')
    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <!-- route('categories.index') -->
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Create New Category</h1>

@endsection


@section('admin-content')

    @include('partials.category-form')

@endsection
