@extends('layouts.admin')

@section('admin-header')
    <h1>PDF Menus</h1>
@endsection

@section('admin-content')

    {{-- Food Menu --}}
    <div class="row my-3 d-flex justify-content-center">
        <div class="card col-md-3">
            <div class="card-body">
                <h5 class="card-title">Food Menu</h5>
                @if ($food_menu->id ?? false)
                    <div>
                        <strong>Filename:</strong><br>
                        <a href="{{ $food_menu->getUrl() }}" target="_blank">{{ $food_menu->filename }}</a>
                    </div>
                    <div>
                        <strong>Uploaded:</strong><br>
                        {{ $food_menu->created_at }}
                    </div>
                    <hr>
                    {!! Form::open([ 'route' => ['admin.pdf-menus.destroy', $food_menu->id], 'method' => 'DELETE' ]) !!}
                        <input type="submit" class="btn btn-sm btn-block btn-danger" value="Delete" />
                    {!! Form::close() !!}
                    <i class="fa fa-info-circle text-info mt-2"></i>
                    <em class="small">To upload a new menu, delete this one first</em>
                @else
                    <p class="card-text">There is no food menu currently uploaded</p>
                    {!! Form::open(['route' => ['admin.pdf-menus.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <input type="file" class="form-control-file" name="file" accept=".pdf,.PDF" required />
                        <input type="hidden" name="type" value="food" />
                        <hr>
                        <input type="submit" class="btn btn-sm btn-success" value="Upload Menu" />
                        <input type="reset" class="btn btn-sm btn-danger" value="Cancel" />
                    {!! Form::close() !!}
                    <i class="fa fa-info-circle text-info mt-2"></i>
                    <em class="small">Menu must be in PDF format</em>
                @endif
            </div>
        </div>

        <div class="card col-md-3 offset-md-1">
            <div class="card-body">
                <h5 class="card-title">Beer Menu</h5>
                @if ($beer_menu->id ?? false)
                    <div>
                        <strong>Filename:</strong><br>
                        <a href="{{ $beer_menu->getUrl() }}" target="_blank">{{ $beer_menu->filename }}</a>
                    </div>
                    <div>
                        <strong>Uploaded:</strong><br>
                        {{ $beer_menu->created_at }}
                    </div>
                    <hr>
                    {!! Form::open(['route' => ['admin.pdf-menus.destroy', $beer_menu->id], 'method' => 'DELETE']) !!}
                        <input type="submit" class="btn btn-sm btn-block btn-danger" value="Delete" />
                    {!! Form::close() !!}
                    <i class="fa fa-info-circle text-info mt-2"></i>
                    <em class="small">To upload a new menu, delete this one first</em>
                @else
                    <p class="card-text">There is no beer menu currently uploaded</p>
                    {!! Form::open(['route' => ['admin.pdf-menus.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <input type="file" class="form-control-file" name="file" accept=".pdf,.PDF" required />
                        <input type="hidden" name="type" value="beer" />
                        <hr>
                        <input type="submit" class="btn btn-sm btn-success" value="Upload Menu" />
                        <input type="reset" class="btn btn-sm btn-danger" value="Cancel" />
                    {!! Form::close() !!}
                    <i class="fa fa-info-circle text-info mt-2"></i>
                    <em class="small">Menu must be in PDF format</em>
                @endif
            </div>
        </div>

        <div class="card col-md-3 offset-md-1">
            <div class="card-body">
                <h5 class="card-title">Party Menu</h5>
                @if ($party_menu->id ?? false)
                    <div>
                        <strong>Filename:</strong><br>
                        <a href="{{ $party_menu->getUrl() }}" target="_blank">{{ $party_menu->filename }}</a>
                    </div>
                    <div>
                        <strong>Uploaded:</strong><br>
                        {{ $party_menu->created_at }}
                    </div>
                    <hr>
                    {!! Form::open(['route' => ['admin.pdf-menus.destroy', $party_menu->id], 'method' => 'DELETE']) !!}
                        <input type="submit" class="btn btn-sm btn-block btn-danger" value="Delete" />
                    {!! Form::close() !!}
                    <i class="fa fa-info-circle text-info mt-2"></i>
                    <em class="small">To upload a new menu, delete this one first</em>
                @else
                    <p class="card-text">There is no party menu currently uploaded</p>
                    {!! Form::open(['route' => ['admin.pdf-menus.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <input type="file" class="form-control-file" name="file" accept=".pdf,.PDF" required />
                        <input type="hidden" name="type" value="party" />
                        <hr>
                        <input type="submit" class="btn btn-sm btn-success" value="Upload Menu" />
                        <input type="reset" class="btn btn-sm btn-danger" value="Cancel" />
                    {!! Form::close() !!}
                    <i class="fa fa-info-circle text-info mt-2"></i>
                    <em class="small">Menu must be in PDF format</em>
                @endif
            </div>
        </div>
    </div>

@endsection
