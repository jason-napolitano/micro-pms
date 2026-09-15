<?php

namespace App\Policies {

    use App\Models;

    class PropertyPolicy
    {
        /**
         * Determine whether the user can view the model.
         *
         * @param Models\User     $user
         * @param Models\Property $property
         *
         * @return bool
         */
        public function view(Models\User $user, Models\Property $property): bool
        {
            return $this->hasAccess($user, $property, 'view_property');
        }

        /**
         * Determine whether the user can update the model.
         *
         * @param Models\User     $user
         * @param Models\Property $property
         *
         * @return bool
         */
        public function update(Models\User $user, Models\Property $property): bool
        {
            return $this->hasAccess($user, $property, 'update_property');
        }

        /**
         * Determine whether the user can delete the model.
         *
         * @param Models\User     $user
         * @param Models\Property $property
         *
         * @return bool
         */
        public function delete(Models\User $user, Models\Property $property): bool
        {
            return $this->hasAccess($user, $property, 'delete_property');
        }

        /**
         * Determine whether the user has permissions to access the model
         *
         * @param Models\User     $user
         * @param Models\Property $property
         * @param string          $permission
         *
         * @return bool
         */
        protected function hasAccess(Models\User $user, Models\Property $property, string $permission): bool
        {
            return $user->properties()->whereKey($property['id'])->exists() && $user->hasPermissionTo($permission);
        }
    }
}
