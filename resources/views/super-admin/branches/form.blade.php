<div class="row">
    <div class="mb-3 col-md-6">
        <label class="form-label">
            Tenant <span class="text-danger">*</span>
        </label>

        <select name="tenant_id" class="form-select @error('tenant_id') is-invalid @enderror">
            <option value="">-- Select Tenant --</option>
            @foreach ($tenants as $tenant)
                <option value="{{ $tenant->id }}" @selected(old('tenant_id', $branch->tenant_id ?? '') == $tenant->id)>
                    {{ $tenant->name }}
                </option>
            @endforeach
        </select>

        @error('tenant_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $branch->code ?? '') }}" placeholder="Code will be generated automatically." readonly>

        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $branch->name ?? '') }}" placeholder="Branch Name">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $branch->email ?? '') }}" placeholder="Email">

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', $branch->phone ?? '') }}" placeholder="Phone">

        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Main Branch</label>
        <select name="is_main" class="form-select">
            <option value="1" @selected(old('is_main', $branch->is_main ?? 0))>
                Yes
            </option>

            <option value="0" @selected(!old('is_main', $branch->is_main ?? 0))>
                No
            </option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Status</label>

        <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active', $branch->is_active ?? 1) == 1 ? 'selected' : '' }}>
                Active
            </option>

            <option value="0" {{ old('is_active', $branch->is_active ?? 1) == 0 ? 'selected' : '' }}>
                Inactive
            </option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label class="form-label">Address</label>

        <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $branch->address ?? '') }}</textarea>

        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <hr class="mb-3 mt-2" />

    <div class="gap-2 d-flex justify-content-end">
        <a href="{{ route('super-admin.branches.index') }}" class="btn btn-light" style="min-width: 160px;">
            Cancel
        </a>

        <button type="submit" class="btn btn-primary" style="min-width: 160px;">
            Save
        </button>
    </div>
</div>
