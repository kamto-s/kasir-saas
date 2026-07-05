<?php

namespace App\Http\Requests\superadmin\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'tenant_id' => ['required', Rule::exists('tenants', 'id')],
            'branch_id' => ['required', Rule::exists('branches', 'id')
                ->where(function ($query) {
                    $query->where('tenant_id', $this->tenant_id);
                })],
            'role_id'   => ['required', Rule::exists('roles', 'id')],
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('user'))],
            'phone'     => ['nullable', 'string', 'max:20'],
            'password'  => ['nullable', 'confirmed', 'min: 8'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
