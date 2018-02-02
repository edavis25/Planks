@extends('layouts.app')

@section('content')

@include('partials.alert')

<h1>{{ $dish->name }}</h1>
<h4>{{ $dish->id }}</h4>
<p>
    {{ $dish->description }}
</p>
<h4>{{ $dish->price }}</h4>
<h3>{{ $dish->category->name }}</h3>

@endsection
