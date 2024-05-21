<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * @OA\Post (
     *     path="/review/create",
     *     tags={"Reviews"},
     *     summary="Добавление отзыва",
     *     description="Добавление отзыва",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(
     *                     @OA\Property(property="name", type="string", example="Название отзыва"),
     *                     @OA\Property(property="text", type="string", example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi laborum magnam maxime quia ut? Aperiam autem"),
     *                     @OA\Property(property="rating_value", type="int", example=1),
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/Review"),
     *             @OA\Property(property="message", type="string", example="Заказ успешно создан.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Ошибка валидации."),
     *             @OA\Property(property="data", type="object", example={})
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return ApiErrorResponse|ApiSuccessResponse
     */
    public function createReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'text' => 'string|required',
            'rating_value' => 'int|required',
        ]);

        if ($validator->fails()) {
            return new ApiErrorResponse('Ошибки валидации.', $validator->errors()->toArray());
        }

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 0;

        $review = Review::create($data);

        return new ApiSuccessResponse($review, 'Отзыв был создан.');
    }

    /**
     * @OA\Patch(
     *     path="/review/{reviewId}",
     *     tags={"Reviews"},
     *     summary="Изменить отзыв",
     *     description="Изменить отзыв",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(
     *                     @OA\Property(property="name", type="string", example="Название отзыва"),
     *                     @OA\Property(property="text", type="string", example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi laborum magnam maxime quia ut? Aperiam autem"),
     *                     @OA\Property(property="rating_value", type="int", example=1),
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/Review"),
     *             @OA\Property(property="message", type="string", example="Отзыв был изменён.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Отзыв не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Отзыв не найден.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Ошибка валидации."),
     *             @OA\Property(property="data", type="object", example={})
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return ApiErrorResponse|ApiSuccessResponse
     */
    public function editReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'text' => 'string|required',
            'rating_value' => 'int|required',
        ]);

        if ($validator->fails()) {
            return new ApiErrorResponse('Ошибки валидации.', $validator->errors()->toArray());
        }

        $review = Review::find($request->input('review_id'));

        if ($review === null || $review->user_id !== auth()->user()->id) {
            return new ApiErrorResponse('Отзыв не найден');
        }

        $data = $request->all();
        $data['status'] = 0;

        $review->update($data);

        return new ApiSuccessResponse($review, 'Отзыв был изменён.');
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Отзыв не существует",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Отзыв не найден.")
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
            return new ApiErrorResponse('Отзыв не найден');
        }

        $review->delete();

        return new ApiSuccessResponse('', 'Отзыв был удален.');
    }
}
