<?php

namespace App\Providers {

    use Illuminate\Support;

    class AppServiceProvider extends Support\ServiceProvider
    {
        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            // enables 'super admin' support
            Support\Facades\Gate::before(static function ($user, $ability) {
                return $user->hasRole('admin') ? true : null;
            });
        }
    }
}
