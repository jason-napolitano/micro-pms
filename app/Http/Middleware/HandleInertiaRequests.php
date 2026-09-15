<?php

namespace App\Http\Middleware {

    use Illuminate\Http\Request;
    use Inertia\Middleware;

    class HandleInertiaRequests extends Middleware
    {
        /**
         * Determines the current asset version.
         *
         * @see https://inertiajs.com/asset-versioning
         */
        public function version(Request $request): ?string
        {
            return parent::version($request);
        }

        /**
         * Define the props that are shared by default.
         *
         * @see https://inertiajs.com/shared-data
         *
         * @return array<string, mixed>
         */
        public function share(Request $request): array
        {
            return [
                ...parent::share($request),
                'auth' => [
                    'permissions' => fn() => $request->user()
                        ? $request->user()->getPermissionsViaRoles()
                        : [],
                    'user'        => fn() => $request->user() ?: null,
                ]
            ];
        }
    }
}
