<?php

namespace App\Services;

use App\Models\MenuType;
use Illuminate\Support\Collection;

class MenuService
{
    /**
     * @return Collection
     */
    public function getMenus(): Collection
    {
        return MenuType::active()->get();
    }

    /**
     * @param string $menuKey
     * @return Collection|null
     */
    public function getMenuItems(string $menuKey): ?Collection
    {
        $menuType = MenuType::query()->where('key', $menuKey)->active()->first();

        return $menuType
            ?->items()
            ->with('children', function ($query) {
                $query->active();
            })
            ->active()
            ->get();
    }
}
