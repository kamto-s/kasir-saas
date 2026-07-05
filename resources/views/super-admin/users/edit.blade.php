@extends('layouts.app')

@section('title', 'Edit User')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.branches.index') }}">@yield('title')</a>
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('super-admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('super-admin.users.form')
            </form>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $(function() {

            const tenant = $('#tenant_id');
            const branch = $('#branch_id');

            let selectedBranch = "{{ old('branch_id', $user->branch_id ?? '') }}";

            function loadBranch() {

                const tenantId = tenant.val();

                branch.prop('disabled', true);
                branch.html('<option value="">Loading...</option>');

                if (!tenantId) {
                    branch.html('<option value="">-- Select Branch --</option>');
                    return;
                }

                $.ajax({

                    url: "{{ route('super-admin.branches.by-tenant', ':id') }}"
                        .replace(':id', tenantId),

                    type: "GET",

                    success: function(response) {

                        let options = '';

                        if (response.length === 0) {

                            options = '<option value="">-- No branch available --</option>';

                            branch.prop('disabled', true);

                        } else {

                            options = '<option value="">-- Select Branch --</option>';

                            $.each(response, function(_, item) {

                                options += `
                            <option value="${item.id}"
                                ${selectedBranch == item.id ? 'selected' : ''}>
                                ${item.name}
                            </option>
                        `;

                            });

                            branch.prop('disabled', false);
                        }

                        branch.html(options);

                    },

                    error: function() {

                        branch.html('<option value="">-- Failed to load branch --</option>');
                        branch.prop('disabled', true);

                    }

                });

            }

            tenant.on('change', function() {

                // Jika user mengganti tenant, branch lama tidak boleh tetap terpilih
                selectedBranch = '';

                loadBranch();

            });

            // Saat halaman edit dibuka
            loadBranch();

        });
    </script>
@endpush
