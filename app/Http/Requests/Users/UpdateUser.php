<?php

namespace App\Http\Requests\Users {

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rules\Password;
    use App\Models\User;

    class UpdateUser extends FormRequest
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
                'name'     => ['nullable', 'string', 'max:255'],
                'username' => ['nullable', 'string', 'max:255', 'unique:' . User::class],
                'email'    => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['nullable', 'confirmed', Password::defaults()],
            ];
        }
    }
}
