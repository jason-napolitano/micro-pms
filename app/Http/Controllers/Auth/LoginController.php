<?php

namespace App\Http\Controllers\Auth {

    use App\Http\Requests\Auth\MemberLogin;
    use Illuminate\Http\RedirectResponse;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class LoginController extends Controller
    {
        /**
         * Handle an incoming authentication request.
         *
         * @param MemberLogin $request
         *
         * @return RedirectResponse
         */
        public function __invoke(MemberLogin $request): RedirectResponse
        {
            // authenticate
            $request->authenticate();

            // session generation
            $request->session()->regenerate();

            // redirect
            return to_route('properties.index');
        }
    }
}
