<?php

namespace App\Http\Requests\Properties {

    use Illuminate\Foundation\Http\FormRequest;

    class StoreProperty extends FormRequest
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
         * @return array
         */
        public function rules(): array
        {
            return [
                'image'   => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
                'address' => ['required', 'string'],
                'phone'   => ['required', 'string'],
                'name'    => ['required', 'string'],
                'code'    => ['required', 'string'],
            ];
        }
    }
}
