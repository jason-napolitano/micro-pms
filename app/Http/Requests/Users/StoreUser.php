<?php

namespace App\Http\Requests\Users {

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rules\Password;
    use App\Models\User;

    class StoreUser extends FormRequest
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
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Password::defaults()],
                'avatar'   => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:8196'],
                'role'     => ['required', 'string', 'exists:roles,name'],
            ];
        }
    }
}
