<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVendor extends FormRequest
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
            'email'         => ['required', 'string', 'unique:vendors,email'],
            'name'          => ['required', 'string', 'unique:vendors,name'],
            'contact_name'  => ['required', 'string'],
            'contact_phone' => ['required', 'string'],
            'contact_email' => ['required', 'string'],
            'phone'         => ['required', 'string'],
        ];
    }
}
