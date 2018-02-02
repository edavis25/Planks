@extends('layouts.admin')

@section('admin-header')
    <a class="btn btn-info text-white mb-2" href="{{ url('/dishes') }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Editing: {{ $dish->name }}</h1>

@endsection


@section('admin-content')

    <div class="row-fluid">
        {!! Form::model($dish, [ 'route' => ['dishes.update', $dish], 'method' => 'put' ] ) !!}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, [ 'required' => 'required', 'class' => 'form-control' ] ) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', null, [ 'required' => 'required', 'class' => 'form-control', 'rows' => 5 ] ) }}
            </div>

            <div class="form-group">
                {{ Form::label('price', 'Price') }}

                {{ Form::text('price', null, array('required' => 'required', 'class' => 'form-control') ) }}
                <small class='d-block'>
                    <i class="fa fa-info-circle"></i>
                    <em>
                        <b>Note:</b> Prices are displayed on site exactly as they are entered here - make sure to include dollar signs, etc.
                        <br>This will allow entries such as: <b>sm...$3.25   lg...$5.50</b>
                    </em>
                </small>
            </div>

            <div class="form-group">
                {{ Form::label('category_id', 'Category') }}
                {{ Form::select('category_id', $categories, null, [ 'class' => 'form-control' ]) }}
            </div>

            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success mr-3"><i class="fa fa-save"></i> Save Changes</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Restore Defaults</button>
            </div>

        {!! Form::close() !!}
    </div>

@endsection
