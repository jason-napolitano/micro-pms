<?php

namespace App\Http\Requests\MakeReady {

    use Illuminate\Contracts\Validation\ValidationRule;
    use Illuminate\Foundation\Http\FormRequest;

    class UpdateMakeReadyItem extends FormRequest
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
                'scheduled_start_at' => ['nullable', 'date'],
                'scheduled_end_at'   => ['nullable', 'date'],
                'estimated_cost'     => ['nullable', 'integer'],
                'completed_at'       => ['nullable', 'date'],
                'cancelled_at'       => ['nullable', 'date'],
                'assigned_to'        => ['nullable', 'exists:users,id'],
                'on_hold_at'         => ['nullable', 'date'],
                'actual_cost'        => ['nullable', 'integer'],
                'started_at'         => ['nullable', 'date'],
                'vendor_id'          => ['nullable', 'exists:vendors,id'],
                'notes'              => ['nullable', 'string'],
            ];
        }
    }
}
