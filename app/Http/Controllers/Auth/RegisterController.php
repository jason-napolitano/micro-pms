<?php

namespace App\Http\Controllers\Auth {

    use App\Http\Requests\Users\RegisterUser;
    use Illuminate\Http\RedirectResponse;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades;
    use App\Models\User;

    class RegisterController extends Controller
    {
        /**
         * Handle an incoming registration request.
         * 
         * @param RegisterUser $request
         *
         * @return RedirectResponse
         */
        public function __invoke(RegisterUser $request): RedirectResponse
        {
            // validation
            $request->validated();

            // create record
            $user = User::create([
                'username' => str($request->username)->slug(),
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Facades\Hash::make($request->password),
            ]);

            // assign role
            $user->assignRole(env('APP_DEFAULT_ROLE'));

            // authenticate
            Facades\Auth::login($user);

            // redirect
            return to_route('properties.index');
        }
    }
}
