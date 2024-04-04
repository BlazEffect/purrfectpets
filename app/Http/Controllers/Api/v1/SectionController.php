<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
use App\Models\CatalogSection;
use Illuminate\Http\JsonResponse;

class SectionController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function getSections(): JsonResponse
    {
        return $this->sendResponse(CatalogSection::active()->get(), '');
    }

    /**
     * @param int $sectionId
     * @return JsonResponse
     */
    public function getChildSections(int $sectionId): JsonResponse
    {
        $section = CatalogSection::find($sectionId);

        if ($section === null) {
            return $this->sendError('Раздел не найден');
        }

        return $this->sendResponse($section->childSections()->active()->get(), '');
    }
}
