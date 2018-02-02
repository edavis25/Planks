@extends('layouts.app')

@section('content')

<div id="admin-wrapper">
    @include('partials.admin-sidebar')

    <div id="admin-content">

        <div class="container pt-3">
            <div class="row-fluid">

                @yield('admin-header')
                <!-- Insert an h1 tag for page title here! -->
                <!-- NOTE: Maybe turn this into a variable? -->

            </div>

            <div class="row-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="container px-0 mx-0">

                            @yield('admin-content')
                            <!-- Use fluid rows in content section -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- /end #admin-content -->
</div> <!-- /end #admin-wrapper -->

@endsection
