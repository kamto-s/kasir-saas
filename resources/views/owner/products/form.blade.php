<div class="mb-3 card">
    <div class="py-3 card-header bg-light">
        <h5 class="mb-0">Product Information</h5>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="mb-3 col-md-6">
                <label class="form-label"> Category <span class="text-danger">*</span> </label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label"> Name <span class="text-danger">*</span> </label>

                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $product->name ?? '') }}" placeholder="Product Name">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3 col-md-12">
                <label class="form-label"> Description </label>
                <textarea name="description" rows="3" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label"> Image </label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">
                    Status
                </label>
                <select name="is_active" class="form-select">
                    <option value="1" @selected(old('is_active', $product->is_active ?? 1) == 1)> Active </option>
                    <option value="0" @selected(old('is_active', $product->is_active ?? 1) == 0)> Inactive </option>
                </select>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="py-3 card-header d-flex justify-content-between align-items-center bg-light">
        <h5 class="mb-0">
            Product Unit Information
        </h5>
    </div>

    <div class="card-body">
        <div id="productUnitWrapper"> </div>

        @include('owner.products.product-unit-template')

        <div class="text-end">
            <button type="button" id="btnAddUnit" class="px-3 border-dashed border-1 btn btn-outline-primary"
                data-total-unit="{{ $units->count() }}">
                <i class="bx bx-plus"></i> Add Unit
            </button>
        </div>
    </div>

</div>

<hr class="mt-4">

<div class="gap-2 d-flex justify-content-end">
    <a href="{{ route('owner.products.index') }}" class="btn btn-light" style="min-width:160px">
        Cancel
    </a>
    <button type="submit" class="btn btn-primary" style="min-width:160px">
        Save
    </button>
</div>
