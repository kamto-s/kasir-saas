<?php

namespace App\Http\Requests\Owner\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'   => ['required', 'exists:categories,id'],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string', 'max:255'],
            'image'         => ['nullable', 'image', 'max:2048'],
            'is_active'     => ['required', 'boolean'],

            'units'                         => ['required', 'array', 'min:1'],
            'units.*.unit_id'               => ['required', 'exists:units,id'],
            'units.*.barcode'               => ['nullable', 'string', 'max:50', 'distinct'],
            'units.*.purchase_price'        => ['required', 'numeric', 'min:0'],
            'units.*.selling_price'         => ['required', 'numeric', 'min:0'],
            'units.*.conversion'            => ['required', 'numeric', 'min:1'],
            'units.*.sort_order'            => ['required', 'integer', 'min:1'],
            'units.*.is_base'               => ['nullable', 'boolean'],
            'units.*.is_default_purchase'   => ['nullable', 'boolean'],
            'units.*.is_default_sale'       => ['nullable', 'boolean'],
            'units.*.is_active'             => ['nullable', 'boolean'],
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'units.*.unit_id.required' => ':attribute wajib dipilih.',
    //         'units.*.purchase_price.required' => ':attribute wajib diisi.',
    //         'units.*.selling_price.required' => ':attribute wajib diisi.',
    //         'units.*.conversion.required' => ':attribute wajib diisi.',
    //     ];
    // }

    public function attributes(): array
    {
        $attributes = [];

        foreach ($this->input('units', []) as $index => $unit) {
            $unitNumber = $index + 1;
            $attributes["units.{$index}.unit_id"] = "Unit produk #{$unitNumber}";
            $attributes["units.{$index}.conversion"] = "Konversi unit #{$unitNumber}";
            $attributes["units.{$index}.purchase_price"] = "Harga beli unit #{$unitNumber}";
            $attributes["units.{$index}.selling_price"] = "Harga jual unit #{$unitNumber}";
        }

        return $attributes;
    }

    public function after(): array
    {
        return [
            function ($validator) {

                $units = $this->input('units', []);

                if (empty($units)) {
                    return;
                }

                $base = collect($units)
                    ->where('is_base', 1)
                    ->count();

                if ($base !== 1) {
                    $validator->errors()->add(
                        'units',
                        'Exactly one Base Unit is required.'
                    );
                }

                $purchase = collect($units)
                    ->where('is_default_purchase', 1)
                    ->count();

                if ($purchase !== 1) {
                    $validator->errors()->add(
                        'units',
                        'Exactly one Default Purchase Unit is required.'
                    );
                }

                $sale = collect($units)
                    ->where('is_default_sale', 1)
                    ->count();

                if ($sale !== 1) {
                    $validator->errors()->add(
                        'units',
                        'Exactly one Default Sale Unit is required.'
                    );
                }
            }
        ];
    }
}
