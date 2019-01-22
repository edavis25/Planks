{{--
  -- If test to bind model to form if an instance is given (ie. editing)
  -- or create a blank form if none given (ie. creating new)
--}}
@if (isset($dish))
    {!! Form::model($dish, ['route' => ['admin.dishes.update', $dish], 'method' => 'PUT', 'files' => true] ) !!}
@else
    {!! Form::open(['route' => 'admin.dishes.store', 'method' => 'POST', 'files' => true]) !!}
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
    <button type="reset" class="btn btn-danger mr-3"><i class="fa fa-refresh"></i> Restore Defaults</button>
    <button class="btn btn-warning float-md-right d-none d-md-block" type="button" data-toggle="collapse" data-target="#upload-file" aria-expanded="false" aria-controls="upload-file">
        <i class="fa fa-image"></i> Image Upload
    </button>
</div>

<div class="collapse" id="upload-file">
    <div class="alert alert-warning">
        <h3><i class="fa fa-warning"></i> This is still an experimental feature</h3>
        <br>
        @if ($dish->image)
            <div class="form-group">
                {{ Form::label('', 'Current Image') }}<br>
                <img class="img img-fluid" src="{{ $dish->thumbnailUrl() }}" style="max-width: 80px;" />
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('file', 'New Image') }}<br>
            {{ Form::file('file') }}
        </div>
    </div>
</div>



{!! Form::close() !!}
