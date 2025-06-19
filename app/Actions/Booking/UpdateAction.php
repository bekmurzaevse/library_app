<?php

namespace App\Actions\Booking;

use App\Dto\Booking\UpdateDto;
use App\Exceptions\ApiResponseException;
use App\Models\Booking;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class UpdateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param int $id
     * @param \App\Dto\Booking\UpdateDto $dto
     * @throws \App\Exceptions\ApiResponseException
     * @return JsonResponse
     */
    public function __invoke(int $id, UpdateDto $dto): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);

            $data = [
                'book_id' => $dto->bookId,
                'status' => $dto->status,
                'return_date' => $dto->status === 'returned' ? now() : null,
            ];

            if ($dto->status === 'returned' && $booking->status !== 'returned') {
                $booking->book->increment('available_copies');
            }

            $booking->update($data);

            return static::toResponse(
                message: "Bron jan'alandi!"
            );
        } catch (ModelNotFoundException $e) {
            throw new ApiResponseException("$id - id li bron bazada tabilmadi!", 404);
        }
    }
}
