@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-success text-white mb-2" href="{{ url('/beers/create') }}">
        <i class="fa fa-plus"></i> New Beer
    </a>
    <h1>Beers</h1>

@endsection

@section('admin-content')
    <!-- Search bar -->
    <div class="row-fluid my-3">

        {!! Form::open([ 'route' => 'admin.beers.index', 'method' => 'GET' ]) !!}

            <div class="input-group mb-3">

                {{ Form::text( 'search', Request::input('search'), ['placeholder' => 'Search beers by name...', 'class' => 'form-control'] ) }}

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
        {{ $beers->links() }}
    </div>


    <div class="row-fluid my-3">
        <!-- Menu Item Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="row">Name</th>
                        <th scope="row">Description</th>
                        <th scope="row">Category</th>
                        <th scope="row">Price</th>
                        <th scope="row">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beers as $beer)
                        <tr>
                            <td>{{ $beer->name }}</td>
                            <td>{{ $beer->description }}</td>
                            <td>{{ $beer->category->name }}</td>
                            <td>{{ $beer->price }}</td>
                            <td style="min-width: 20%;">
                                <a href="{{ route('admin.beers.edit', [ 'beers' => $beer ]) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                {{-- Toggle delete confirm --}}
                                <a class="btn btn-danger btn-sm" data-toggle="collapse" href="#deleteBeer-{{ $beer->id }}" role="button">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                {{-- Collapsed form for confirming delete --}}
                                <div class="collapse mt-2" id="deleteBeer-{{ $beer->id }}">
                                    Are you sure?
                                    {{-- "Yes" form --}}
                                    {!! Form::open([ 'route' => ['admin.beers.destroy', $beer], 'method' => 'DELETE', 'class' => 'd-inline-block' ]) !!}
                                        <button type="submit" class="btn-hidden" style="color: #0086F9; cursor: pointer;">yes</button>
                                    {!! Form::close() !!}
                                    &nbsp;/&nbsp; <!-- Choice separator " / "-->
                                    {{-- "No" toggle closed confirm --}}
                                    <a data-toggle="collapse" href="#deleteBeer-{{ $beer->id }}" role="button"> no</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
