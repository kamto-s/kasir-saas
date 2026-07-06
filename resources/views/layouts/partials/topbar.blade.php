<div class="navbar-custom">
    <div class="topbar">
        <div class="gap-1 topbar-menu d-flex align-items-center gap-lg-2">

            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a class='logo-light' href='index.html'>
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo" class="logo-lg" height="22">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="22">
                </a>

                <!-- Brand Logo Dark -->
                <a class='logo-dark' href='index.html'>
                    <img src="{{ asset('assets/images/logo/logo-text-light_2.png') }}" alt="dark logo" class="logo-lg"
                        height="22">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="22">
                </a>
            </div>

            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <div>
                <h4 class="mb-0 fw-bold text-uppercase">{{ optional(auth()->user()->tenant)->name }}</h4>
            </div>
        </div>

        <ul class="gap-4 topbar-menu d-flex align-items-center">

            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="#" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen font-size-24"></i>
                </a>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-magnify font-size-24"></i>
                </a>
                <div class="p-0 dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..."
                            aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="nav-link" id="theme-mode">
                <i class="bx bx-moon font-size-24"></i>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">

                    <div class="text-center text-white bg-primary rounded-circle me-2"
                        style="width: 36px; height: 36px; line-height: 36px; font-weight: bold; font-size: 14px;">
                        @php
                            $words = explode(' ', auth()->user()->name);
                            $initials = strtoupper(
                                substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''),
                            );
                        @endphp
                        {{ $initials }}
                    </div>

                    <span class="ms-1 d-none d-md-inline-flex align-items-center">
                        <div class="d-flex flex-column text-start me-2">
                            <span class="fw-bold lh-1mb-1">{{ auth()->user()->name }}</span>
                            <small class="text-muted">
                                {{ auth()->user()->role->name }}
                            </small>
                        </div>
                        <i class="mdi mdi-chevron-down ->fs-4"></i>
                    </span>
                </a>
                <div class="py-3 dropdown-menu dropdown-menu-end profile-dropdown">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="bx bx-user-circle"></i>
                        <span>Profile</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="bx bx-cog"></i>
                        <span>Settings</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item">
                            <i class="bx bx-log-out me-2"></i>
                            Logout
                        </button>
                    </form>

                </div>
            </li>

        </ul>
    </div>
</div>
