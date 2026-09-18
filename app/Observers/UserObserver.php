<?php

namespace App\Observers {

    use App\Models;

    class UserObserver
    {
        public function created(Models\User $user): void
        {
            if (Models\User::count() === 1) {
                $user->assignRole('admin');
            }
        }
    }
}
