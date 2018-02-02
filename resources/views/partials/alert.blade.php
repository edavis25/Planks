@if (Session::has('flash_message'))
    <div class="alert alert-{{ Session::get('flash_status') }} alert-dismissible fade show" role="alert">
        <strong>{{ ucfirst(Session::get('flash_status')) }}!</strong> {{ Session::get('flash_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
