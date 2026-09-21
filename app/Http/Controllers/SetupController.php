<?php

namespace App\Http\Controllers {

    use App\Http\Requests\Setup\StoreAdminUser;
    use Illuminate\Http\RedirectResponse;
    use App\Models\User;

    class SetupController extends Controller
    {
        /**
         * Handle an incoming registration request.
         *
         * @param StoreAdminUser $request
         *
         * @return RedirectResponse
         */
        public function __invoke(StoreAdminUser $request): RedirectResponse
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
