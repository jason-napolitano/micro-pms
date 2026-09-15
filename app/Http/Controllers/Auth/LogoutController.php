<?php

namespace App\Http\Controllers\Auth {

    use App\Http\Controllers\Controller;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class LogoutController extends Controller
    {
        /**
         * Destroy an authenticated session.
         */
        public function __invoke(Request $request): RedirectResponse
        {
            // logout
            Auth::guard('web')->logout();

            // session invalidation
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // redirect
            return to_route('login');
        }
    }
}
