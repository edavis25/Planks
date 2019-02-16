@extends('layouts.admin')

@section('admin-header')

    <h1>Specials</h1>

@endsection

@section('admin-content')

    <div class="row-fluid">
        @foreach ($days as $day)
            <h3>{{ ucfirst($day->name) }}</h3>

            @if (! $day->specials->isEmpty())
                @foreach ($day->specials ?? [] as $special)
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card">
                    <div class="card-body">
                        <em>There are no specials for {{ ucfirst($day->name) }}</em>
                    </div>
                </div>
            @endif

        @endforeach


        <table class="table">
            @foreach ($days as $day)
                <thead>
                    <tr>
                        <td>{{ ucfirst($day->name) }}</td>
                    </tr>
                </thead>
                <tbody>
                    @if (! $day->specials->isEmpty())
                        @foreach ($day->specials ?? [] as $special)
                            <tr>
                                <td>{{ $special->description }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td><strong>There are no specials for {{ ucfirst($day->name) }}</strong></td>
                        </tr>
                    @endif
                </tbody>
            @endforeach
        </table>
    </div>

@endsection
