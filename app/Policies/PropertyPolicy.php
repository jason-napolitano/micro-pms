<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PropertyPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Property $property): bool
    {
        return $this->hasAccess($user, $property, 'view_property');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Property $property): bool
    {
        return $this->hasAccess($user, $property, 'update_property');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Property $property): bool
    {
        return $this->hasAccess($user, $property, 'delete_property');
    }

    protected function hasAccess(User $user, Property $property, string $permission): bool
    {
        return $user->properties()->whereKey($property['id'])->exists() && $user->hasPermissionTo($permission);
    }
}
