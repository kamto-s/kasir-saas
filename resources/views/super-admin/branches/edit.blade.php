@extends('layouts.app')

@section('title', 'Edit Tenant')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.branches.index') }}">Tenant</a>
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('super-admin.branches.update', $branch) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('super-admin.branches.form')
            </form>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
