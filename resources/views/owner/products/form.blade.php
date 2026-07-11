 {{-- error --}}
 @if ($errors->any())
     <div class="mb-3 alert alert-danger">
         <ul class="mb-0">
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
 <div class="mb-3 card">
     <div class="py-3 card-header bg-light">
         <h5 class="mb-0">Product</h5>
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

 <div class="mb-3 card">
     <div class="py-3 card-header d-flex justify-content-between align-items-center bg-light">
         <h5 class="mb-0">
             Product Unit
         </h5>
     </div>

     <div class="card-body">
         <template x-for="(unit,index) in units" :key="index">
             <div class="mb-3 border card">
                 <div class="py-3 bg-opacity-10 card-header d-flex justify-content-between align-items-center bg-info">
                     <h6 class="mb-0 fw-bold">
                         Unit #
                         <span x-text="index + 1"></span>
                         <template x-if="unit.unit_id">
                             <span>
                                 - <span x-text="unitName(unit.unit_id)"></span>
                             </span>
                         </template>
                     </h6>
                     <button type="button" class="btn btn-outline-danger btn-sm" @click="removeUnit(index)"
                         x-show="units.length > 1">
                         <i class="bx bx-trash"></i>
                     </button>
                 </div>
                 <div class="card-body bg-info bg-opacity-10">

                     <div class="row">
                         {{-- Unit --}}
                         <div class="mb-3 col-md-4">
                             <label class="form-label"> Unit <span class="text-danger">*</span> </label>
                             <select class="form-select" x-model="unit.unit_id" :name="'units[' + index + '][unit_id]'">
                                 <option value=""> -- Select Unit -- </option>

                                 @foreach ($units as $item)
                                     <option value="{{ $item->id }}">
                                         {{ $item->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         {{-- Conversion --}}
                         <div class="mb-3 col-md-4">
                             <label class="form-label"> Conversion </label>
                             <input type="number" class="form-control" x-model="unit.conversion"
                                 :readonly="unit.is_base" :name="'units[' + index + '][conversion]'">
                         </div>

                         {{-- Barcode --}}
                         <div class="mb-3 col-md-4">
                             <label class="form-label"> Barcode </label>
                             <input x-model="unit.barcode" :name="'units[' + index + '][barcode]'" class="form-control"
                                 placeholder="Exp: 123456">
                         </div>

                         {{-- Purchase Price --}}
                         <div class="mb-3 col-md-4">
                             <label class="form-label"> Purchase Price </label>

                             <div class="mb-2 input-group">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text">Rp</div>
                                 </div>

                                 <input type="text" class="form-control" :value="formatRupiah(unit.purchase_price)"
                                     @input="unit.purchase_price = parseRupiah($event.target.value)" placeholder="0">
                                 <input type="hidden" :name="'units[' + index + '][purchase_price]'"
                                     :value="unit.purchase_price">
                             </div>
                         </div>

                         {{-- Selling Price --}}
                         <div class="mb-3 col-md-4">
                             <label class="form-label"> Selling Price </label>
                             <div class="mb-2 input-group">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text">Rp</div>
                                 </div>

                                 <input type="text" class="form-control" :value="formatRupiah(unit.selling_price)"
                                     @input="unit.selling_price = parseRupiah($event.target.value)" placeholder="0">
                                 <input type="hidden" :name="'units[' + index + '][selling_price]'"
                                     :value="unit.selling_price">
                             </div>


                         </div>

                         {{-- Sort Order --}}
                         <input type="hidden" x-model="unit.sort_order" :name="'units[' + index + '][sort_order]'">

                         {{-- options --}}
                         <div class="col-4">
                             <label class="form-label d-block"> Options </label>
                             <div class="flex-wrap gap-4 d-flex">
                                 <div class="form-check">
                                     <input type="checkbox" value="1" x-model="unit.is_base"
                                         @change="setBase(index)" :name="'units[' + index + '][is_base]'"
                                         class="form-check-input">
                                     <label class="form-check-label"> Base Unit </label>
                                 </div>

                                 <div class="form-check">
                                     <input type="checkbox" value="1" class="form-check-input"
                                         x-model="unit.is_default_purchase" @change="setDefaultPurchase(index)"
                                         :name="'units[' + index + '][is_default_purchase]'">
                                     <label class="form-check-label"> Default Purchase </label>
                                 </div>

                                 <div class="form-check">
                                     <input type="checkbox" value="1" class="form-check-input"
                                         x-model="unit.is_default_sale" @change="setDefaultSale(index)"
                                         :name="'units[' + index + '][is_default_sale]'">
                                     <label class="form-check-label"> Default Sale </label>
                                 </div>

                                 <div class="form-check">
                                     <input type="checkbox" value="1" class="form-check-input"
                                         x-model="unit.is_active" :name="'units[' + index + '][is_active]'">

                                     <label class="form-check-label"> Active </label>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </template>

         <div class="text-end">
             <button type="button" class="px-3 btn btn-outline-primary" @click="addUnit()"
                 :disabled="units.length === maxUnits">
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
