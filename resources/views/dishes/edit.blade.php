@extends('layouts.admin')

@section('admin-header')
    <a class="btn btn-info text-white pull-right mt-1" href="{{ url('/dishes') }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Editing: {{ $dish->name }}</h1>
@endsection


@section('admin-content')

    <div class="row-fluid">

    </div>

@endsection
