@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Editing: {{ $user->name }}</h1>

@endsection

@section('admin-content')
    {!! Form::model($user, [ 'route' => ['admin.users.update', $user], 'method' => 'PUT' ] ) !!}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, [ 'required' => 'required', 'class' => 'form-control' ] ) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, [ 'required' => 'required', 'class' => 'form-control' ] ) }}
    </div>

    <div class="form-group mt-4">
        <div class="alert alert-info">
            Password changes must be handled via the "Reset Your Password" link on the login screen.
        </div>
    </div>

    <div class="form-group mt-4">
        <h4>Permissions</h4>

        <div class="custom-control custom-checkbox">
            {{ Form::checkbox('is_admin', null, null, [ 'class' => 'custom-control-input', 'id' => 'admin' ]) }}
            <label class="custom-control-label" for="admin">Administrator</label>
        </div>
        <i class="fa fa-info-circle"></i> <small><em><b>Note:</b> Administrators can edit menu items and specials but cannot manage other users.</em></small>
        <div class="custom-control custom-checkbox mt-3">
            {{ Form::checkbox('is_super_user', null, null, [ 'class' => 'custom-control-input', 'id' => 'super_user' ]) }}
            <label class="custom-control-label" for="super_user">Super User</label>
        </div>
        <span class="text-danger"><i class="fa fa-warning"></i> <small><em><b>Warning:</b> Super users are able to set permission levels and edit other users. <b>Add super users with caution.</b></em></small></span>
    </div>

    <div class="form-group mt-5">
        <button type="submit" class="btn btn-success mr-3"><i class="fa fa-save"></i> Save Changes</button>
        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Restore Defaults</button>
    </div>

    {!! Form::close() !!}
@endsection
