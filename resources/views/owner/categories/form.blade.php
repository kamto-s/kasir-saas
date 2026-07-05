<div class="row">
    <div class="mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $category->name ?? '') }}" placeholder="Category Name">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>

        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description ?? '') }}</textarea>

        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>

        <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active', $category->is_active ?? 1) == 1 ? 'selected' : '' }}>
                Active
            </option>

            <option value="0" {{ old('is_active', $category->is_active ?? 1) == 0 ? 'selected' : '' }}>
                Inactive
            </option>
        </select>
    </div>

    <hr class="mt-2 mb-3" />

    <div class="gap-2 d-flex justify-content-end">
        <a href="{{ route('owner.categories.index') }}" class="btn btn-light" style="min-width: 160px;">
            Cancel
        </a>

        <button type="submit" class="btn btn-primary" style="min-width: 160px;">
            Save
        </button>
    </div>
</div>
