@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Users</h1>

@endsection


@section('admin-content')

    <!-- Search bar -->
    <div class="row-fluid my-3">

        {!! Form::open([ 'route' => 'admin.users.index', 'method' => 'GET' ]) !!}

            <div class="input-group mb-3">

                {{ Form::text( 'search', Request::input('search'), ['placeholder' => 'Search users by name...', 'class' => 'form-control'] ) }}

                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

        {!! Form::close() !!}

    </div>

    <!-- Pagination -->
    <div class="row-fluid my-3">
        {{ $users->links() }}
    </div>

    <div class="row-fluid my-3">
        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Permission Level</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_super_user)
                                    Super User
                                @elseif ($user->is_admin)
                                    Administrator
                                @else
                                    No Permissions
                                @endif
                            </td>
                            <td style="min-width: 20%">
                                <a href="{{ route('admin.users.edit', [ 'user' => $user ]) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                {{-- Toggle delete confirm --}}
                                <a class="btn btn-danger btn-sm" data-toggle="collapse" href="#deleteUser-{{ $user->id }}" role="button">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                {{-- Collapsed form for confirming delete --}}
                                <div class="collapse mt-2" id="deleteUser-{{ $user->id }}">
                                    Are you sure?
                                    {{-- "Yes" form --}}
                                    {!! Form::open([ 'route' => ['admin.users.destroy', $user], 'method' => 'DELETE', 'class' => 'd-inline-block' ]) !!}
                                        <button type="submit" class="btn-hidden" style="color: #0086F9; cursor: pointer;">yes</button>
                                    {!! Form::close() !!}
                                    &nbsp;/&nbsp; <!-- Choice separator " / "-->
                                    {{-- "No" toggle closed confirm --}}
                                    <a data-toggle="collapse" href="#deleteUser-{{ $user->id }}" role="button"> no</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

@endsection
