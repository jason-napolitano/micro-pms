<?php

namespace App\Http\Middleware {

    use App\Models;
    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class HandleLoginRequests
    {
        /**
         * Handle an incoming request.
         *
         * @param Closure(Request): (Response) $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            $adminExists = Models\User::role('admin')->exists();

            if (!$adminExists) {
                return to_route('setup');
            }

            return $next($request);
        }
    }
}
