@extends('layouts.app')

@section('title', 'Tenant')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        Tenant
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h4 class="header-title">@yield('title') List</h4>

                        <a href="{{ route('super-admin.tenants.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i>
                            Add @yield('title')
                        </a>
                    </div>

                    <hr class="mb-4">

                    {{-- skeleton table --}}
                    <div id="tableSkeleton" class="table-responsive placeholder-glow">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="gap-2 d-flex align-items-center">
                                <span class="rounded placeholder" style="width: 190px; height: 18px;"></span>
                            </div>
                            <div class="gap-2 d-flex align-items-center">
                                <span class="rounded placeholder" style="width: 190px; height: 18px;"></span>
                            </div>

                        </div>
                        <table class="table align-middle table-bordered">
                            <thead>
                                <tr>
                                    <th width="60"><span class="placeholder col-8"></span></th>
                                    <th><span class="placeholder col-10"></span></th>
                                    <th><span class="placeholder col-9"></span></th>
                                    <th><span class="placeholder col-11"></span></th>
                                    <th><span class="placeholder col-8"></span></th>
                                    <th width="100"><span class="placeholder col-8"></span></th>
                                    <th width="120"><span class="placeholder col-9"></span></th>
                                </tr>
                            </thead>

                            <tbody>
                                @for ($i = 0; $i < 5; $i++)
                                    <tr>
                                        <td><span class="placeholder col-8"></span></td>
                                        <td><span class="placeholder col-10"></span></td>
                                        <td><span class="placeholder col-9"></span></td>
                                        <td><span class="placeholder col-11"></span></td>
                                        <td><span class="placeholder col-8"></span></td>

                                        <td>
                                            <span class="placeholder rounded-pill col-8"></span>
                                        </td>

                                        <td>
                                            <div class="gap-2 d-flex">
                                                <span class="rounded placeholder" style="width:32px;height:32px;"></span>
                                                <span class="rounded placeholder" style="width:32px;height:32px;"></span>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        <div class="mt-3 d-flex justify-content-between align-items-center">

                            <span class="rounded placeholder" style="width:190px;height:18px;"></span>

                            <div class="gap-1 d-flex">
                                @for ($i = 0; $i < 4; $i++)
                                    <span class="rounded placeholder" style="width:34px;height:34px;"></span>
                                @endfor
                            </div>

                        </div>
                    </div>

                    <div id="tableWrapper" class="table-hidden">
                        <table id="tenantTable" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css" rel="stylesheet">
    <style>
        #tableWrapper {
            opacity: 0;
            transition: opacity .2s;
        }
        #tableWrapper.show {
            opacity: 1;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    <script>
        $(function() {
            let table = $('#tenantTable').DataTable({
                processing: false,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('super-admin.tenants.data') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '60px',
                        className: 'text-center',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        width: '120px'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        width: '120px',
                        className: 'text-center',
                        searchable: false,
                        orderable: false
                    }
                ],
                initComplete: function() {

                    $('#tableSkeleton').hide();

                    $('#tableWrapper').show().addClass('show');

                }
            });
        });
    </script>
@endpush
