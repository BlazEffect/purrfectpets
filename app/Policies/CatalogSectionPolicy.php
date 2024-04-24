<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogSectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any catalog sections.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_catalog::section');
    }

    /**
     * Determine whether the user can view the catalog section.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->can('view_catalog::section');
    }

    /**
     * Determine whether the user can create catalog sections.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_catalog::section');
    }

    /**
     * Determine whether the user can update the catalog section.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->can('update_catalog::section');
    }

    /**
     * Determine whether the user can delete the catalog section.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->can('delete_catalog::section');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param User $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_catalog::section');
    }
}
