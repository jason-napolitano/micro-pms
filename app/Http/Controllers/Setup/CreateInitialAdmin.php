<?php

namespace App\Http\Controllers\Setup {

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Auth\RegisterUser;
	use App\Models\User;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Support\Facades;

	class CreateInitialAdmin extends Controller
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
            $user->assignRole('admin');

            // authenticate
            Facades\Auth::login($user);

            // redirect
            return to_route('properties.index');
        }
    }
}
