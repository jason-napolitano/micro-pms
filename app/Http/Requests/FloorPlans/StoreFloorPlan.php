<?php

namespace App\Http\Requests\FloorPlans {

	use Illuminate\Contracts\Validation\ValidationRule;
	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Validation\Rule;

	class StoreFloorPlan extends FormRequest
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
                'property_id' => ['required', 'string', 'exists:properties,id'],
                'bathrooms'   => ['required', 'integer'],
                'bedrooms'    => ['required', 'integer'],
                'square_feet' => ['required', 'integer'],
                'label'       => ['required', 'string', Rule::unique('floor_plans', 'label')->where('property_id', $this->property_id)],
            ];
        }
    }
}
