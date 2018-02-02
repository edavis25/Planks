@extends('layouts.app')

<!--
    NOTE: Refactor this to use the admin layout. This page is currently
    serving as the reference used to create the layout
-->

@section('content')

<div id="admin-wrapper">
    @include('partials.admin-sidebar')

    <div id="admin-content" class="pb-3">
    <!-- Include all above for admin pages -->

        <div class="container pt-3">
            <div class="row-fluid">
                <a class="btn btn-success text-white pull-right mt-1">
                    <i class="fa fa-plus"></i>
                    New Dish
                </a>
                <h1>Dishes</h1>
            </div>
            <div class="row-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="container px-0 mx-0">
                            <!-- Search bar -->
                            <div class="row-fluid my-3">

                                {!! Form::open([ 'url' => '/dishes', 'method' => 'GET' ]) !!}

                                    <div class="input-group mb-3">

                                         {{ Form::text( 'search', Request::input('search'), ['placeholder' => 'Search menu items...', 'class' => 'form-control'] ) }}

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
                                {{ $dishes->links() }}
                            </div>
                            <!-- Menu Item Table -->
                            <div class="table-responsive">
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
                                            <td style="min-width: 20%;" class="text-white">
                                                <a href="{{ route('dishes.edit', [ 'dish' => $dish ]) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- /end .table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /end #admin-content -->
</div> <!-- /end #admin-wrapper -->
@endsection
