<?php

namespace App\Policies {

    use App\Models;

    class VendorPolicy
    {
        /**
         * Determine whether the user can create models.
         *
         * @param Models\User $user
         *
         * @return bool
         */
        public function create(Models\User $user): bool
        {
            return false;
        }

        /**
         * Determine whether the user can update the model.
         *
         * @param Models\User   $user
         * @param Models\Vendor $vendor
         *
         * @return bool
         */
        public function update(Models\User $user, Models\Vendor $vendor): bool
        {
            return false;
        }

        /**
         * Determine whether the user can delete the model.
         *
         * @param Models\User   $user
         * @param Models\Vendor $vendor
         *
         * @return bool
         */
        public function delete(Models\User $user, Models\Vendor $vendor): bool
        {
            return false;
        }

        /**
         * Determine whether the user can restore the model.
         *
         * @param Models\User   $user
         * @param Models\Vendor $vendor
         *
         * @return bool
         */
        public function restore(Models\User $user, Models\Vendor $vendor): bool
        {
            return false;
        }

        /**
         * Determine whether the user can permanently delete the model.
         *
         * @param Models\User   $user
         * @param Models\Vendor $vendor
         *
         * @return bool
         */
        public function forceDelete(Models\User $user, Models\Vendor $vendor): bool
        {
            return false;
        }
    }
}
