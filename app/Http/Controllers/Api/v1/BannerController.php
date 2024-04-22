<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiSuccessResponse;
use App\Models\Banner;

class BannerController extends BaseApiController
{
    /**
     * @return ApiSuccessResponse
     */
    public function getBanners(): ApiSuccessResponse
    {
        $banners = Banner::query()
            ->active()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        return new ApiSuccessResponse($banners, '');
    }
}
