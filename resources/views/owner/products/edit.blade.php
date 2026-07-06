@extends('layouts.app')

@section('title', 'Edit Unit')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('owner.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('owner.units.index') }}">Unit</a>
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

                    <form action="{{ route('owner.units.update', $unit) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('owner.units.form')
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
