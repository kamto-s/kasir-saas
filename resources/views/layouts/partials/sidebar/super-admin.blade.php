<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <a class='logo-light' href='#'>
            <img src="{{ asset('assets/images/logo/logo-text-light_7.png') }}" alt="logo" class="logo-lg"
                height="28">
            <img src="{{ asset('assets/images/logo/logo-sm_2.png') }}" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a class='logo-dark' href='#'>
            <img src="{{ asset('assets/images/logo/logo-text-light_2.png') }}" alt="dark logo" class="logo-lg"
                height="28">
            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}">
                <a class='menu-link waves-effect waves-light' href='{{ route('super-admin.dashboard') }}'>
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                </a>
            </li>

            <li class="menu-title">management</li>
            <li class="menu-item {{ request()->routeIs('super-admin.tenants.*') ? 'active' : '' }}">
                <a class='menu-link waves-effect waves-light' href='{{ route('super-admin.tenants.index') }}'>
                    <span class="menu-icon"><i class="bx bx-buildings"></i></span>
                    <span class="menu-text"> Tenant </span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('super-admin.branches.*') ? 'active' : '' }}">
                <a class='menu-link waves-effect waves-light' href='{{ route('super-admin.branches.index') }}'>
                    <span class="menu-icon"><i class="bx bx-store"></i></span>
                    <span class="menu-text"> Branch </span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('super-admin.users.*') ? 'active' : '' }}">
                <a class='menu-link waves-effect waves-light' href='{{ route('super-admin.users.index') }}'>
                    <span class="menu-icon"><i class="bx bx-user-circle"></i></span>
                    <span class="menu-text"> User </span>
                </a>
            </li>

            <li class="menu-title">Access Control</li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-shield-quarter"></i></span>
                    <span class="menu-text"> Role </span>
                </a>
            </li>

            <li class="menu-title">System</li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-cog"></i></span>
                    <span class="menu-text"> Setting </span>
                </a>
            </li>
        </ul>
    </div>
</div>
