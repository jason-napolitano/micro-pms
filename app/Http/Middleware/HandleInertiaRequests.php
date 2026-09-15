<?php

namespace App\Http\Middleware {

    use Illuminate\Http\Request;
    use Inertia\Middleware;

    class HandleInertiaRequests extends Middleware
    {
        /**
         * @inheritdoc
         */
        public function version(Request $request): ?string
        {
            return parent::version($request);
        }

        /**
         * @inheritdoc
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
