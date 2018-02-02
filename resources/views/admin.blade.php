@extends('layouts.app')

@section('content')

<div id="admin-wrapper">
    @include('partials.admin-sidebar')

    <div id="admin-content">
        <h1>Admin Dashboard</h1>

        <a href="{{ url('admin/registration_code') }}" class="btn btn-success">Generate Registration Code</a>
    <div> <!-- /end #admin-content -->

</div> <!-- /end #admin-wrapper -->

@endsection
