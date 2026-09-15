<?php

namespace App\Http\Requests\MakeReady;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignee extends FormRequest
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
            'vendor_id'   => ['nullable', 'string', 'exists:vendors,id'],
            'assigned_to' => ['nullable', 'string', 'exists:users,id'],
        ];
    }
}
