@extends('layouts.app')

@section('title', 'Edit Category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('owner.categories.index') }}">Category</a>
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('owner.categories.update', $category) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('owner.categories.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
