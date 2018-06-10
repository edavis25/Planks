@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-success text-white mb-2" href="{{ route('admin.categories.create') }}">
        <i class="fa fa-plus"></i> New Category
    </a>
    <h1>Categories</h1>

@endsection

@section('admin-content')
    <!-- Search bar -->
    <div class="row-fluid my-3">
        {!! Form::open([ 'route' => 'admin.categories.index', 'method' => 'GET' ]) !!}

            <div class="input-group mb-3">

                 {{ Form::text( 'search', Request::input('search'), ['placeholder' => 'Search categories by name...', 'class' => 'form-control'] ) }}

                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

        {!! Form::close() !!}
    </div> <!-- /end .row-fluid -->

    <!-- Pagination -->
    <div class="row-fluid my-3">
        {{ $categories->links() }}
    </div> <!-- /end .row-fluid -->

    <!-- Categories table -->
    <div class="row-fluid my-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Additional Details</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->details }}</td>
                            <td style="min-width: 20%">
                                <a href="{{ route('admin.categories.edit', [ 'category' => $cat ]) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                {{-- Toggle delete confirm --}}
                                <a class="btn btn-danger btn-sm" data-toggle="collapse" href="#deleteCategory-{{ $cat->id }}" role="button">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                                {{-- Collapsed form for confirming delete --}}
                                <div class="collapse mt-2" id="deleteCategory-{{ $cat->id }}">
                                    Are you sure?
                                    {{-- "Yes" form --}}
                                    {!! Form::open([ 'route' => ['admin.categories.destroy', $cat], 'method' => 'DELETE', 'class' => 'd-inline-block' ]) !!}
                                        <button type="submit" class="btn-hidden" style="color: #0086F9; cursor: pointer;">yes</button>
                                    {!! Form::close() !!}
                                    &nbsp;/&nbsp; <!-- Choice separator " / "-->
                                    {{-- "No" toggle closed confirm --}}
                                    <a data-toggle="collapse" href="#deleteDish-{{ $cat->id }}" role="button"> no</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </div> <!-- /end .table-responsive -->
    </div> <!-- /end .row-fluid -->

@endsection
