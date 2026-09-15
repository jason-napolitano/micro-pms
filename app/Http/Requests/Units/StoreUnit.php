<?php

namespace App\Http\Requests\Units {

	use Illuminate\Foundation\Http\FormRequest;

	class StoreUnit extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string>
         */
        public function rules(): array
        {
            return [
                'floor_plan_id' => ['required', 'exists:floor_plans,id'],
                'property_id'   => ['required', 'exists:properties,id'],
                'unit_number'   => ['required', 'string', 'max:125', 'unique:units,unit_number'],
            ];
        }
    }
}
