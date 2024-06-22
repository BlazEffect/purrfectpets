<?php

namespace App\Services;

use App\Models\Page;

class PageService
{
    /**
     * @param string $url
     * @return Page
     */
    public function getPageByUrl(string $url): Page
    {
        return Page::query()
            ->where('url', $url)
            ->active()
            ->first();
    }
}
