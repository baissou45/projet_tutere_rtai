<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="mt-2">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('template/back/assets/images/logo.png') }}" class="w-50" alt="logo">
            </a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu" class="mt-4">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="text-white dripicons-device-desktop" aria-hidden="true"></i>
                        </i><span> Dashbord </span></a>
                </li>

                <li class="menu-title">Main</li>

                {{-- <li>
                    <a href="{{ route('rooms.index') }}" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span> Room Liste </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('rooms.create') }}" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span> Create Room </span>
                    </a>
                </li>

                <li class="menu-title">Booking</li>

                <li>
                    <a href="{{ route('bookings.create') }}" class="waves-effect">
                        <i class="dripicons-calendar"></i>
                        <span> Create Booking </span>
                    </a>
                </li> --}}

                <li>
                    <a href="{{ route('apiSearch') }}" class="waves-effect">
                        <i class="dripicons-search"></i>
                        <span> Search Booking </span>
                    </a>
                </li>

            </ul>

        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->