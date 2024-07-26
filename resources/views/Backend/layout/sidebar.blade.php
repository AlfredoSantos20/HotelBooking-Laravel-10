 <!-- Sidebar -->
 <ul style="background:#17A2B8; " class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('hotel-de-luna/dashboard')}}">

        <div class="sidebar-brand-text mx-3">Hotel De Luna</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 bg-light">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">

            <a @if(Session::get('page')=="dashboard") style="background:#0a515c !important; color:#fff !important;" @endif class="nav-link" href="{{url('hotel-de-luna/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider bg-light">

    <!-- Heading -->
    <div class="sidebar-heading text-light">
        Interface
    </div>

    @if(Auth::guard('midware')->user()->acc_type=="sub-admin")


    @else



    <li class="nav-item">

        <a @if(Session::get('page')=="users-management" || Session::get('page')=="employee" || Session::get('page')=="customers") style="background:#0a515c !important; color:#fff !important;" @endif  class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-users text-light"></i>
            <span>Users Management</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a @if(Session::get('page')=="employee") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('users-management/accounts')}}">Accounts</a>
                <a @if(Session::get('page')=="customers") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('users-management/customers')}}">Customers</a>
                <a @if(Session::get('page')=="employee") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('users-management/employee')}}">Employees</a>

            </div>
        </div>
    </li>


    <li class="nav-item">
        <a @if(Session::get('page')=="banners-management" || Session::get('page')=="banners") style="background:#0a515c !important; color:#fff !important;" @endif class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-image text-light"></i>
            <span>Banners Management</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">Banners/Backgrounds</h6>
                <a @if(Session::get('page')=="banners") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('banners-management/banners')}}">Banners/Background</a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a @if(Session::get('page')=="rooms-management" || Session::get('page')=="rooms" || Session::get('page')=="room-type") style="background:#0a515c !important; color:#fff !important;" @endif class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rooms"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-door-open text-light"></i>
            <span>Room Management</span>
        </a>
        <div id="rooms" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">Rooms</h6>
                <a @if(Session::get('page')=="rooms") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('rooms-management/rooms')}}">Rooms</a>
                <a @if(Session::get('page')=="room-type") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('rooms-management/roomtype')}}">RoomType</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a @if(Session::get('page')=="foods-management" || Session::get('page')=="mains") style="background:#0a515c !important; color:#fff !important;" @endif class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#food"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-utensils text-light"></i>
            <span>Food Management</span>
        </a>
        <div id="food" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">Menu</h6>
                <a @if(Session::get('page')=="mains") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('foods-management/foods')}}">Mains</a>

            </div>
        </div>
    </li>




    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block bg-light">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline ">
        <button class="rounded-circle border-0 " id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
