<?php

namespace App\Http\Requests\MakeReady {

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateSchedule extends FormRequest
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
                'scheduled_start_at' => ['nullable', 'date'],
                'scheduled_end_at'   => ['nullable', 'date'],
            ];
        }
    }
}
