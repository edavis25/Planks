<aside id="admin-sidebar">
    <section id="admin-sidebar-content">

        <div id="admin-user-info">
            <span class="circle">
                {{ substr(Request::user()->name, 0, 1) }}
            </span>
            <div class="username">
                <b>{{ Request::user()->name }}</b>
                @if (Request::user()->is_super_user)
                    <small class="role">Super User</small>
                @else
                    <small class="role">Administrator</small>
                @endif
            </div>
        </div>

        <div class="sidebar-links">
            <div class="sidebar-item bg-gray-dark text-gray-lighter">
                <b>MENU MANAGEMENT</b>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-list-ul pr-2" aria-hidden="true"></i>
                <a class="sidebar-link" href="{{ route('admin.categories.index') }}">Menu Categories</a>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-cutlery pr-2" aria-hidden="true"></i>
                <a class="sidebar-link" href="{{ route('admin.dishes.index') }}">Dishes</a>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-beer pr-2" aria-hidden="true"></i>
                <a class="sidebar-link" href="{{ route('admin.beers.index') }}">Beers</a>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-file-pdf-o pr-2" aria-hidden="true"></i>
                <a class="sidebar-link" href="{{ route('admin.pdf-menus.index') }}">PDF Menus</a>
            </div>
            <div class="sidebar-item bg-gray" id="special-accordian" data-toggle="collapse" data-target="#special-collapsed">
                <a class="sidebar-link" href="#">Daily Specials</a>
                <i class="fa fa-chevron-down float-right mr-3 mt-1"></i>
            </div>

            <div id="special-collapsed" class="collapse" aria-labelledby="headingOne" data-parent="#special-accordion">
                <div class="sidebar-item bg-gray-light">
                    <i class="fa fa-plus pr-2"></i>
                    <a class="sidebar-link" href="#">Create</a>
                </div>
                <div class="sidebar-item bg-gray-light">
                    <i class="fa fa-edit pr-2"></i>
                    <a class="sidebar-link" href="{{ route('admin.specials.index')   }}">Manage</a>
                </div>
            </div>

            <div class="sidebar-item bg-gray-dark text-gray-lighter">
                <b>ADMINISTRATIVE</b>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-user pr-2"></i>
                <a class="sidebar-link" href="{{ route('admin.users.index') }}">Manage Users</a>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-key pr-2"></i>
                <a class="sidebar-link" href="{{ route('admin.registration-code.create') }}">Registration Code</a>
            </div>

            <div class="sidebar-item bg-gray-dark text-gray-lighter">
                <b>USER</b>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-sign-out pr-2"></i>
                <a href="{{ route('logout') }}" class="sidebar-link"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" class="dropdown-item form-inline my-2 my-lg-0">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </section>
</aside>
