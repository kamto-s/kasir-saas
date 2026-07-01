<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <a class='logo-light' href='index.html'>
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo" class="logo-lg" height="28">
            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a class='logo-dark' href='index.html'>
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" class="logo-lg" height="28">
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

            <li class="menu-title">Master Data</li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-category"></i></span>
                    <span class="menu-text"> Category </span>
                </a>
            </li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-purchase-tag"></i></span>
                    <span class="menu-text"> Brand </span>
                </a>
            </li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-ruler"></i></span>
                    <span class="menu-text"> Unit </span>
                </a>
            </li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-package"></i></span>
                    <span class="menu-text"> Product </span>
                </a>
            </li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bxs-truck"></i></span>
                    <span class="menu-text"> Supplier </span>
                </a>
            </li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-user"></i></span>
                    <span class="menu-text"> Customer </span>
                </a>
            </li>

            <li class="menu-title">Inventory</li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-box"></i></span>
                    <span class="menu-text"> Stock </span>
                </a>
            </li>

            <li class="menu-title">Transaction</li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-cart-alt"></i></span>
                    <span class="menu-text"> POS </span>
                </a>
            </li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-receipt"></i></span>
                    <span class="menu-text"> Sales </span>
                </a>
            </li>

            <li class="menu-title">Setting</li>

            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-bar-chart-alt-2"></i></span>
                    <span class="menu-text"> Report </span>
                </a>
            </li>
            <li class="menu-item">
                <a class='menu-link waves-effect waves-light' href='#'>
                    <span class="menu-icon"><i class="bx bx-cog"></i></span>
                    <span class="menu-text"> Setting </span>
                </a>
            </li>
        </ul>
    </div>
</div>
