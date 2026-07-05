<div class="row">
    <div class="mb-3 col-md-6">
        <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name ?? '') }}" placeholder="Full Name">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $user->phone ?? '') }}" placeholder="Phone">

            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email ?? '') }}" placeholder="Email">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            @if (!isset($user))
                <label class="form-label">Password <span class="text-danger">*</span></label>
            @else
                <label class="form-label">Password</label>
                <small class="text-muted">(Leave blank if you don't want to change the password)</small>
            @endif
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password" autocomplete="new-password">

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="Confirm Password">

            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Tenant <span class="text-danger">*</span>
            </label>

            <select name="tenant_id" class="form-select @error('tenant_id') is-invalid @enderror" id="tenant_id">
                <option value="">-- Select Tenant --</option>
                @foreach ($tenants as $tenant)
                    <option value="{{ $tenant->id }}" @selected(old('tenant_id', $user->tenant->id ?? '') == $tenant->id)>
                        {{ $tenant->name }}
                    </option>
                @endforeach
            </select>

            @error('tenant_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">
                Branch <span class="text-danger">*</span>
            </label>

            <select id="branch_id" name="branch_id" class="form-select @error('branch_id') is-invalid @enderror">
                <option value="">-- Select Branch --</option>
            </select>

            @error('branch_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">
                Role <span class="text-danger">*</span>
            </label>

            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" id="role_id">
                <option value="">-- Select Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>

            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>

            <select name="is_active" class="form-select">
                <option value="1" {{ old('is_active', $user->is_active ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0" {{ old('is_active', $user->is_active ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>
    </div>

    <hr class="mt-2 mb-3" />

    <div class="gap-2 d-flex justify-content-end">
        <a href="{{ route('super-admin.users.index') }}" class="btn btn-light" style="min-width: 160px;">
            Cancel
        </a>

        <button type="submit" class="btn btn-primary" style="min-width: 160px;">
            Save
        </button>
    </div>
</div>
