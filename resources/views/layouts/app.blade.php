<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Moro App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/libs/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    @stack('styles')
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    @include('sweetalert::alert')

    <div class="layout-wrapper">

        @if (auth()->user()->role->code === 'SUPER_ADMIN')
            @include('layouts.partials.sidebar.super-admin')
        @elseif (auth()->user()->role->code === 'OWNER')
            @include('layouts.partials.sidebar.owner')
        @elseif (auth()->user()->role->code === 'CASHIER')
            @include('layouts.partials.sidebar.cashier')
        @endif

        <div class="page-content">

            @include('layouts.partials.topbar')

            <div class="px-3">
                <div class="container-fluid">
                    @include('layouts.partials.breadcumb')

                    @yield('content')
                </div>
            </div>

            @include('layouts.partials.footer')

        </div>

    </div>

    @include('layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
