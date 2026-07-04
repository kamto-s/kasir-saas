<?php

namespace App\Http\Requests\superadmin\branch;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBranchRequest extends FormRequest
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
        $branch = $this->route('branch');

        return [
            'tenant_id' => [
                'required',
                Rule::exists('tenants', 'id'),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
                'max:500',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'is_main' => [
                'required',
                'boolean',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
