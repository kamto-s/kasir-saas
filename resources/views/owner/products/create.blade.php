@extends('layouts.app')

@section('title', 'Create Product')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('owner.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('owner.products.index') }}">Product</a>
    </li>
    <li class="breadcrumb-item active">
        Create
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $masterUnits = $units->map(
                    fn($item) => [
                        'id' => $item->id,
                        'name' => $item->name,
                    ],
                );

                $oldUnits = old('units', []);
            @endphp

            <form x-data="productForm(@js($masterUnits), @js($oldUnits))" action="{{ route('owner.products.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                @include('owner.products.form')

            </form>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
