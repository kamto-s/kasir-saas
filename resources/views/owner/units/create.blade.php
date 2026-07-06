@extends('layouts.app')

@section('title', 'Create Unit')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('owner.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('owner.categories.index') }}">Unit</a>
    </li>
    <li class="breadcrumb-item active">
        Create
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('owner.units.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
