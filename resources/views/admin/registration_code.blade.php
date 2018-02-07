@extends('layouts.admin')

@section('admin-header')

    <a class="btn btn-info text-white mb-2" href="{{ URL::previous() }}">
        <i class="fa fa-arrow-left"></i>
        Back
    </a>
    <h1>Generate Registration Code</h1>

@endsection


@section('admin-content')
    <i class="fa fa-3x fa-info-circle text-info mb-3"></i>
    <p>
        A unique registration code is required for all new user registrations. Once a code has been generated,
        it must be given to the user so they can enter it into the appropriate field on the account registration
        page.
    </p>
    <p>
        Once a user successfully creates an account using the provided code, they will still need to be given
        permissions before they are granted access to any administrative options. To allow access, a super user
        must edit the new user's profile using the <code class="p-1">Manage Users</code> link in the admin dashboard navigation panel.
        After opening the Manage Users page, click the <code class="p-1">Edit</code> button for the new user from the list and use the
        checkboxes to grant permissions to the user.
    </p>
    <h4>Additional Details</h4>
    <ul>
        <li>Only Super Users can generate registration codes</li>
        <li>Each registration code can only be used <b>once</b></li>
        <li>You must generate a new code for each new user</small>
        <li>Codes that have already been generated cannot be retrieved later</li>
        <li>Codes are only required for initial registration</li>
        <li>After registration, users will need to be granted permissions by a Super User</li>
    </ul>

    <a href="{{ route('generate_code') }}" class="btn btn-success mt-5 ml-4"
        onclick="event.preventDefault();
                 document.getElementById('reg-code').submit();">
        <i class="fa fa-qrcode"></i> Generate New Code
    </a>
    <form id="reg-code" action="{{ route('generate_code') }}" method="POST" class="d-none">
        {{ csrf_field() }}
    </form>
@endsection
