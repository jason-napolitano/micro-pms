<?php

namespace App\Http\Requests\MakeReady {

    use Illuminate\Contracts\Validation\ValidationRule;
    use Illuminate\Foundation\Http\FormRequest;

    class StoreMakeReady extends FormRequest
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
                'expected_at' => ['nullable', 'date'],
                'started_at'  => ['required', 'date'],
                'unit_id'     => ['required', 'exists:units,id'],
            ];
        }
    }
}
