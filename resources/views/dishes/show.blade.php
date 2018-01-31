@extends('layouts.app')

@section('content')

<h1>{{ $dish->name }}</h1>
<p>
    {{ $dish->description }}
</p>
<h3>{{ $dish->category->name }}</h3>

@endsection
