<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label">Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $tenant->code ?? '') }}" placeholder="Tenant Code">

        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $tenant->name ?? '') }}" placeholder="Tenant Name">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $tenant->email ?? '') }}" placeholder="Email">

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', $tenant->phone ?? '') }}" placeholder="Phone">

        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Logo</label>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">

        @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Status</label>

        <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active', $tenant->is_active ?? 1) == 1 ? 'selected' : '' }}>
                Active
            </option>

            <option value="0" {{ old('is_active', $tenant->is_active ?? 1) == 0 ? 'selected' : '' }}>
                Inactive
            </option>
        </select>
    </div>

</div>
<hr class="mb-4" />

<div class="gap-2 d-flex justify-content-end">
    <a href="{{ route('super-admin.tenants.index') }}" class="btn btn-light" style="min-width: 160px;">
        Cancel
    </a>

    <button type="submit" class="btn btn-primary" style="min-width: 160px;">
        Save
    </button>
</div>
