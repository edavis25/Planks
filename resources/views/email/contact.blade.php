@extends('layouts.email')

@section('content')
    <h2>Someone has submitted the party request form</h2>
    <div>
        <div style="margin-top: 10px">
            <strong>Name:</strong> {!! $name ?? '<em>not given</em>' !!}
        </div>
        <div style="margin-top: 10px">
            <strong>Phone:</strong> {!! $phone ?? '<em>not given</em>' !!}
        </div>
        <div style="margin-top: 10px">
            <strong>Date:</strong> {!! $date ?? '<em>not given</em>' !!}
        </div>
        <div style="margin-top: 10px">
            <strong>Description:</strong> {!! $description ?: '<em>not given</em>' !!}
        </div>
    </div>
@endsection
