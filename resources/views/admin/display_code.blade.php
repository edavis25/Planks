@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Registration Code</h1>

@endsection

@section('admin-content')
    <p>
        Your registration code has been created! Provide this code so a user can create a new account.
        <br><b>This code expires in 24 hours</b>
    </p>
    <p class="text-danger">
        <i class="fa fa-warning"></i><em> After leaving this page, this code cannot be recovered.</em>
    </p>
    <p class="text-info">
        <i class="fa fa-info-circle"></i><em> Don't forget that you will still have to grant permissions after the user has
            created a new account.</em>
    </p>
    <h3 class="mt-5">Your Code:</h3>
    <div class="alert alert-primary">
        <h4>{{ $code }}</h4>
    </div>
@endsection
