@extends('layouts.app')
@section('content')

<h1>Admin Dashboard</h1>

<a href="{{ url('registration_code') }}" class="btn btn-success">Generate Registration Code</a>
@endsection
