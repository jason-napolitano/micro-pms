<?php

namespace App\Http\Requests\MakeReady {

    use Illuminate\Foundation\Http\FormRequest;
    use App\Models\Enums\MakeReadyStatus;
    use Illuminate\Validation\Rules\Enum;

    class UpdateStatus extends FormRequest
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
                'status' => ['required', 'string', new Enum(MakeReadyStatus::class)],
            ];
        }
    }
}
