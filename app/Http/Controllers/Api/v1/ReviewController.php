<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Review;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ReviewController extends BaseApiController
{
    /**
     * @OA\Get (
     *     path="/reviews",
     *     tags={"Reviews"},
     *     summary="Получение отзывов",
     *     description="Получение отзывов",
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Review")
     *             ),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getReviews()
    {
        return new ApiSuccessResponse(Review::moderated()->get(), '');
    }

    /**
     * @OA\Delete (
     *     path="/review/{reviewId}",
     *     tags={"Reviews"},
     *     summary="Удаление отзывва",
     *     description="Удаление отзыва",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\Parameter(
     *         name="reviewId",
     *         description="ID отзыва",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="string", example=""),
     *             @OA\Property(property="message", type="string", example="Отзыв был удален")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return ApiErrorResponse|ApiSuccessResponse
     */
    public function deleteReview(Request $request)
    {
        $reviewId = $request->get('reviewId');

        $review = Review::find($reviewId);

        if ($review === null || $review->user_id !== auth()->user()->id) {
            return new ApiErrorResponse('Отзыв не был найден');
        }

        $review->delete();

        return new ApiSuccessResponse('', 'Отзыв был удален.');
    }
}
