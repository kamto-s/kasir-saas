@extends('layouts.app')

@section('title', 'Create User')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('super-admin.users.index') }}">User</a>
    </li>
    <li class="breadcrumb-item active">
        Create
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('super-admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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

            $('#tenant_id').on('change', function() {

                let tenantId = $(this).val();
                let branch = $('#branch_id');

                branch.prop('disabled', true);
                branch.html('<option value="">Loading...</option>');

                if (!tenantId) {
                    branch.html('<option value="">-- Select Branch --</option>');
                    branch.prop('disabled', false);
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
                                                <option value="${item.id}">
                                                    ${item.name}
                                                </option>
                                            `;
                            });

                            branch.prop('disabled', false);
                        }

                        branch.html(options);

                        if (response.length === 1) {
                            branch.val(response[0].id);
                        }
                    },

                    error: function() {
                        branch.html('<option value="">-- Failed to load branch --</option>');
                        branch.prop('disabled', true);
                    }
                });

            });

        });
    </script>
@endpush
