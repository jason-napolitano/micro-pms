<?php

namespace App\Http\Middleware {

    use Symfony\Component\HttpFoundation\Response;
    use Illuminate\Http\Request;
    use App\Models;
    use Closure;

    class HandleApplicationSetup
    {
        /**
         * Handle an incoming request.
         *
         * @param Closure(Request): (Response) $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            $adminExists = Models\User::role('admin')->exists();

            if ($adminExists) {
                return to_route('login');
            }

            return $next($request);
        }
    }
}
