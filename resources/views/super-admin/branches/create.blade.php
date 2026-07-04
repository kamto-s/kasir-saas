@extends('layouts.app')

@section('title', 'Create Branch')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.branches.index') }}">Branch</a>
    </li>
    <li class="breadcrumb-item active">
        Create
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('super-admin.branches.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('super-admin.branches.form')
            </form>

        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
