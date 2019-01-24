@extends('layouts.admin')

@section('admin-header')
    <h1>Admin Dashboard</h1>
@endsection

@section('admin-content')
    <div class="container-fluid">
        <div class="row">
            <div>
                <h5>Quick Links</h5>
                <hr>
                <h3>Categories</h3>
                <p>Edit and create categories. Categories are composed of either food dishes or beers.</p>
                <a href="{{ route('admin.categories.index') }}" class="text-primary">Manage Categories</a>
                <hr>
                <h3>Dishes</h3>
                <p>Edit and create new food menu items.</p>
                <a href="{{ route('admin.dishes.index') }}" class="text-primary">Manage Dishes</a>
                <hr>
                <h3>Beer</h3>
                <p>Edit and create new beers.</p>
                <a href="{{ route('admin.beers.index') }}" class="text-primary">Manage Beers</a>
            </div>
        </div>
    </div>
@endsection
