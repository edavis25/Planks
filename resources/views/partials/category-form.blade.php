{{--
  -- If test to bind model to form if an instance is given (ie. editing)
  -- or create a blank form if none given (ie. creating new)
--}}
@if (isset($category))
    {!! Form::model($category, [ 'route' => ['admin.categories.update', $category], 'method' => 'PUT' ] ) !!}
@else
    {!! Form::open([ 'route' => 'admin.categories.store', 'method' => 'POST' ]) !!}
@endif

{{-- Display any validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Display the actual form fields --}}
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, [ 'required' => 'required', 'class' => 'form-control' ] ) }}
</div>

<div class="form-group">
    {{ Form::label('details', 'Additional Details') }}<small><em> optional</em></small>
    {{ Form::textarea('details', null, [ 'class' => 'form-control', 'rows' => 3 ] ) }}
</div>

<div class="form-group mt-5">
    <button type="submit" class="btn btn-success mr-3"><i class="fa fa-save"></i> Save Changes</button>
    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Restore Defaults</button>
</div>

{!! Form::close() !!}
