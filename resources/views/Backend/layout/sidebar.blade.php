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
            <i class="fas fa-fw fa-cog"></i>
            <span>Users Management</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a @if(Session::get('page')=="employee") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('users-management/employee')}}">Employees</a>
                <a @if(Session::get('page')=="customers") style="background:#0a515c !important; color:#fff !important;" @endif class="collapse-item" href="{{ url('users-management/customers')}}">Customers</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a @if(Session::get('page')=="banners-management" || Session::get('page')=="banners") style="background:#0a515c !important; color:#fff !important;" @endif class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
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


    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
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
