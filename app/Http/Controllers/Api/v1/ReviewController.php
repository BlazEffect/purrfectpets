<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\EditReviewRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Services\EmailService;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ReviewController extends BaseApiController
{
    public function __construct(
        private readonly ReviewService $reviewService,
        private readonly EmailService $emailService
    ){}

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
    public function getReviews(): ApiSuccessResponse
    {
        $reviews = $this->reviewService->getModeratedReviews();

        return new ApiSuccessResponse($reviews, '');
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
     *                     @OA\Property(property="rating_value", type="int", example=1)
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
     *             @OA\Property(property="message", type="string", example="Отзыв был создан.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
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
     * @param CreateReviewRequest $request
     * @return ApiSuccessResponse
     */
    public function createReview(CreateReviewRequest $request): ApiSuccessResponse
    {
        $request->validated();

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 0;

        $review = $this->reviewService->createReview($data);

        $this->emailService->sendCreateReviewMail($review);

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
     *     @OA\Parameter(
     *         name="reviewId",
     *         description="ID отзыва",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(
     *                     @OA\Property(property="name", type="string", example="Название отзыва"),
     *                     @OA\Property(property="text", type="string", example="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi laborum magnam maxime quia ut? Aperiam autem"),
     *                     @OA\Property(property="rating_value", type="int", example=1)
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
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
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
     * @param EditReviewRequest $request
     * @return ApiErrorResponse|ApiSuccessResponse
     */
    public function editReview(EditReviewRequest $request, int $reviewId): ApiErrorResponse|ApiSuccessResponse
    {
        $request->validated();

        $review = $this->reviewService->editReview($reviewId, $request->all());

        if ($review === null) {
            return new ApiErrorResponse('Отзыв не найден');
        }

        $this->emailService->sendEditReviewMail($review);

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
     *             @OA\Property(property="message", type="string", example="Отзыв был удален.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Не существует",
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
        $deleted = $this->reviewService->deleteReview($request->get('reviewId'));

        if (!$deleted) {
            return new ApiErrorResponse('Отзыв не найден');
        }

        return new ApiSuccessResponse('', 'Отзыв был удален.');
    }
}
