<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Collection;

class ReviewService
{
    /**
     * @return Collection|null
     */
    public function getModeratedReviews(): ?Collection
    {
        return Review::moderated()->get();
    }

    /**
     * @param array $data
     * @return Review
     */
    public function createReview(array $data): Review
    {
        return Review::create($data);
    }

    /**
     * @param int $reviewId
     * @param array $data
     * @return Review|null
     */
    public function editReview(int $reviewId, array $data): ?Review
    {
        $review = Review::find($reviewId);

        if ($review === null || $review->user_id !== auth()->user()->id) {
            return null;
        }

        $review->update($data);

        return $review;
    }

    /**
     * @param int $reviewId
     * @return bool
     */
    public function deleteReview(int $reviewId): bool
    {
        $review = Review::find($reviewId);

        if ($review === null || $review->user_id !== auth()->user()->id) {
            return false;
        }

        $review->delete();

        return true;
    }
}
