{{--
  -- If test to bind model to form if an instance is given (ie. editing)
  -- or create a blank form if none given (ie. creating new)
--}}
@if (isset($category))
    {!! Form::model($category, [ 'route' => ['categories.update', $category], 'method' => 'PUT' ] ) !!}
@else
    {!! Form::open([ 'route' => 'categories.store', 'method' => 'POST' ]) !!}
@endif

{{-- Display the actual form fields --}}
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, [ 'required' => 'required', 'class' => 'form-control' ] ) }}
</div>

<div class="form-group mt-5">
    <button type="submit" class="btn btn-success mr-3"><i class="fa fa-save"></i> Save Changes</button>
    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Restore Defaults</button>
</div>

{!! Form::close() !!}
