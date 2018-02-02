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
                <i class="fa fa-list-ul pr-2"></i>
                <a class="sidebar-link" href="#">Menu Categories</a>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-cutlery pr-2"></i>
                <a class="sidebar-link" href="{{ url('/dishes') }}">Dishes</a>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-beer pr-2"></i>
                <a class="sidebar-link" href="#">Beers</a>
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
                    <a class="sidebar-link" href="#">Manage</a>
                </div>
            </div>

            <div class="sidebar-item bg-gray-dark text-gray-lighter">
                <b>ADMINISTRATIVE</b>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-user pr-2"></i>
                <a class="sidebar-link" href="#">Manage Users</a>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-key pr-2"></i>
                <a class="sidebar-link" href="#">Registration Code</a>
            </div>

            <div class="sidebar-item bg-gray-dark text-gray-lighter">
                <b>USER</b>
            </div>
            <div class="sidebar-item bg-gray-light">
                <i class="fa fa-sign-out pr-2"></i>
                <a class="sidebar-link" href="#">Logout</a>
            </div>
        </div>
    </section>
</aside>
