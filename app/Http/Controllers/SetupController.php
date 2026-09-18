<?php

namespace App\Http\Controllers {

    use App\Http\Requests\Auth\RegisterUser;
    use App\Models\User;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades;

    class SetupController extends Controller
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
            // create record
            $user = User::create($request->validated());

            // assign role
            $user->assignRole('admin');

            // redirect
            return to_route('login');
        }
    }
}
