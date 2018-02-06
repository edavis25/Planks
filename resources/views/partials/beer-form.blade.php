{{--
  -- If test to bind model to form if an instance is given (ie. editing)
  -- or create a blank form if none given (ie. creating new)
--}}
@if (isset($beer))
    {!! Form::model($beer, [ 'route' => ['beers.update', $beer], 'method' => 'PUT' ] ) !!}
@else
    {!! Form::open([ 'route' => 'beers.store', 'method' => 'POST' ]) !!}
@endif

{{-- Display the actual form fields --}}
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
