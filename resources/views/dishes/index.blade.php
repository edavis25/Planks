@extends('layouts.admin')

@section('admin-header')

    <h1>Dishes</h1>

@endsection

@section('admin-content')

    <div class="row-fluid">
        <a class="btn btn-success text-white mb-2" href="{{ route('admin.dishes.create') }}">
            <i class="fa fa-plus"></i> New Dish
        </a>
    </div>
    <!-- Search bar -->
    <div class="row-fluid my-3">

        {!! Form::model($_REQUEST, [ 'route' => 'admin.dishes.index', 'method' => 'GET' ]) !!}

            <div class="input-group mb-3">

                 {{ Form::text( 'search', Request::input('search'), ['placeholder' => 'Search dishes by name...', 'class' => 'form-control'] ) }}

                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
    </div>

    <div class="row-fluid">

        <div class="input-group col-md-4 col-lg-3 pull-right px-0">
            {{ Form::select('category', $categories, null, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) }}
        </div>

        <div class="d-md-none clearfix"></div>

        {{-- Pagination Links --}}
        {{ $dishes->links() }}

        {!! Form::close() !!}
    </div>

    <!-- Menu Item Table -->
    <div class="table-responsive py-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col" class="d-none d-lg-block">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dishes as $dish)
                <tr>
                    <td>{{ $dish->name }}</td>
                    <td class="d-none d-lg-block">{{ $dish->description }}</td>
                    <td>{{ $dish->category->name }}</td>
                    <td>{{ $dish->price }}</td>
                    <td style="min-width: 20%;">
                        <a href="{{ route('admin.dishes.edit', [ 'dish' => $dish ]) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        {{-- Toggle delete confirm --}}
                        <a class="btn btn-danger btn-sm" data-toggle="collapse" href="#deleteDish-{{ $dish->id }}" role="button">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                        {{-- Collapsed form for confirming delete --}}
                        <div class="collapse mt-2" id="deleteDish-{{ $dish->id }}">
                            Are you sure?
                            {{-- "Yes" form --}}
                            {!! Form::open([ 'route' => ['admin.dishes.destroy', $dish], 'method' => 'DELETE', 'class' => 'd-inline-block' ]) !!}
                                <button type="submit" class="btn-hidden" style="color: #0086F9; cursor: pointer;">yes</button>
                            {!! Form::close() !!}
                            &nbsp;/&nbsp; <!-- Choice separator " / "-->
                            {{-- "No" toggle closed confirm --}}
                            <a data-toggle="collapse" href="#deleteDish-{{ $dish->id }}" role="button"> no</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- /end .table-responsive -->

@endsection
