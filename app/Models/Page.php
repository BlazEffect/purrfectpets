<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function resolveRouteBinding($value, $field = null): Page|null
    {
        return $this->where($field, $value)->where('active', true)->first();
    }
}
