@extends('layouts.admin')

@section('admin-header')
    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <!-- route('categories.index') -->
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Editing: {{ $category->name }}</h1>

@endsection


@section('admin-content')

    @include('partials.category-form')

    <h4 class="mt-5 mb-0">Items associated with this category:</h4>
    <small><em>Note: To change items associated with this category you must edit the menu item itself</em></small>
    <div class="list-group">
        @foreach ($category->dishes as $dish)
            <a href="{{ route('dishes.edit', $dish) }}" class="list-group-item list-group-item-action">{{ $dish->name }}</a>
        @endforeach

        @foreach ($category->beers as $beer)
            <a href="{{ route('beers.edit', $beer) }}" class="list-group-item list-group-item-action">{{ $beer->name }}</a>
        @endforeach
    </div>

@endsection
