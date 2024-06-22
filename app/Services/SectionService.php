<?php

namespace App\Services;

use App\Models\CatalogSection;
use Illuminate\Support\Collection;

class SectionService
{
    public function getActiveSections(): Collection
    {
        $sections = CatalogSection::active()->get();

        if ($sections->isNotEmpty()) {
            $sections->map(fn(CatalogSection $section) => $section->image = Storage::disk('sections')->url($section->image));
        }

        return $sections;
    }

    public function getChildSections(int $sectionId): ?Collection
    {
        $section = CatalogSection::find($sectionId);

        if ($section === null) {
            return null;
        }

        $childSections = $section->childSections()->active()->get();

        if ($childSections->isNotEmpty()) {
            $childSections->map(fn(CatalogSection $section) => $section->image = Storage::disk('sections')->url($section->image));
        }

        return $childSections;
    }
}
