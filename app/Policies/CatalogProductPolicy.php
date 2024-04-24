<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any catalog products.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_catalog::product');
    }

    /**
     * Determine whether the user can view the catalog product.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->can('view_catalog::product');
    }

    /**
     * Determine whether the user can create catalog products.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_catalog::product');
    }

    /**
     * Determine whether the user can update the catalog product.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->can('update_catalog::product');
    }

    /**
     * Determine whether the user can delete the catalog product.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->can('delete_catalog::product');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param User $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_catalog::product');
    }
}
