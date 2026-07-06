<template id="productUnitTemplate">

    <div class="mb-3 border card product-unit-item">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 product-unit-title fw-bold">
                Product Unit #1
            </h6>
            <button type="button" class="btn btn-outline-danger btn-sm btnRemoveUnit">
                <i class="bx bx-trash"></i> Delete
            </button>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Unit --}}
                <div class="mb-3 col-md-3">

                    <label class="form-label">
                        Unit <span class="text-danger">*</span>
                    </label>

                    <select name="units[__INDEX__][unit_id]" class="form-select product-unit-select">

                        <option value="">
                            -- Select Unit --
                        </option>

                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">
                                {{ $unit->name }}
                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- Conversion --}}
                <div class="mb-3 col-md-2">

                    <label class="form-label">
                        Conversion
                    </label>

                    <input type="number" step="0.01" min="1" value="1" class="form-control conversion"
                        name="units[__INDEX__][conversion]">

                </div>

                {{-- Barcode --}}
                <div class="mb-3 col-md-3">

                    <label class="form-label">
                        Barcode
                    </label>

                    <input type="text" class="form-control" name="units[__INDEX__][barcode]" placeholder="Barcode">

                </div>

                {{-- Purchase Price --}}
                <div class="mb-3 col-md-2">

                    <label class="form-label">
                        Purchase Price
                    </label>

                    <input type="number" min="0" value="0" class="form-control purchase-price"
                        name="units[__INDEX__][purchase_price]">

                </div>

                {{-- Selling Price --}}
                <div class="mb-3 col-md-2">

                    <label class="form-label">
                        Selling Price
                    </label>

                    <input type="number" min="0" value="0" class="form-control selling-price"
                        name="units[__INDEX__][selling_price]">

                </div>

                <input type="hidden" class="sort-order" name="units[__INDEX__][sort_order]" value="1">

                <div class="col-12">

                    <label class="form-label d-block">
                        Options
                    </label>

                    <div class="flex-wrap gap-4 d-flex">

                        <div class="form-check">

                            <input class="form-check-input is-base" type="checkbox" value="1"
                                name="units[__INDEX__][is_base]">

                            <label class="form-check-label">
                                Base Unit
                            </label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input default-purchase" type="checkbox" value="1"
                                name="units[__INDEX__][is_default_purchase]">

                            <label class="form-check-label">
                                Default Purchase
                            </label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input default-sale" type="checkbox" value="1"
                                name="units[__INDEX__][is_default_sale]">

                            <label class="form-check-label">
                                Default Sale
                            </label>

                        </div>

                        <div class="form-check">

                            <input class="form-check-input" type="checkbox" value="1" checked
                                name="units[__INDEX__][is_active]">

                            <label class="form-check-label">
                                Active
                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>
