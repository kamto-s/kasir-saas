@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        Category
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <span class="badge badge-soft-primary float-end">Daily</span>
                        <h5 class="mb-0 card-title">Cost per Unit</h5>
                    </div>
                    <div class="mb-4 row d-flex align-items-center">
                        <div class="col-8">
                            <h2 class="mb-0 d-flex align-items-center">
                                $17.21
                            </h2>
                        </div>
                        <div class="col-4 text-end">
                            <span class="text-muted">12.5% <i class="mdi mdi-arrow-up text-success"></i></span>
                        </div>
                    </div>

                    <div class="shadow-sm progress" style="height: 5px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <span class="badge badge-soft-primary float-end">Per Week</span>
                        <h5 class="mb-0 card-title">Market Revenue</h5>
                    </div>
                    <div class="mb-4 row d-flex align-items-center">
                        <div class="col-8">
                            <h2 class="mb-0 d-flex align-items-center">
                                $1875.54
                            </h2>
                        </div>
                        <div class="col-4 text-end">
                            <span class="text-muted">18.71% <i class="mdi mdi-arrow-down text-danger"></i></span>
                        </div>
                    </div>

                    <div class="shadow-sm progress" style="height: 5px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <span class="badge badge-soft-primary float-end">Per Month</span>
                        <h5 class="mb-0 card-title">Expenses</h5>
                    </div>
                    <div class="mb-4 row d-flex align-items-center">
                        <div class="col-8">
                            <h2 class="mb-0 d-flex align-items-center">
                                $784.62
                            </h2>
                        </div>
                        <div class="col-4 text-end">
                            <span class="text-muted">57% <i class="mdi mdi-arrow-up text-success"></i></span>
                        </div>
                    </div>

                    <div class="shadow-sm progress" style="height: 5px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <span class="badge badge-soft-primary float-end">All Time</span>
                        <h5 class="mb-0 card-title">Daily Visits</h5>
                    </div>
                    <div class="mb-4 row d-flex align-items-center">
                        <div class="col-8">
                            <h2 class="mb-0 d-flex align-items-center">
                                1,15,187
                            </h2>
                        </div>
                        <div class="col-4 text-end">
                            <span class="text-muted">17.8% <i class="mdi mdi-arrow-down text-danger"></i></span>
                        </div>
                    </div>

                    <div class="shadow-sm progress" style="height: 5px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 57%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
