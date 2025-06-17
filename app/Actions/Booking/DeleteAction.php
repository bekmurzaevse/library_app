<?php

namespace App\Actions\Booking;

use App\Exceptions\ApiResponseException;
use App\Models\Booking;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class DeleteAction
{
    use ResponseTrait;
    
    /**
     * Summary of __invoke
     * @param int $id
     * @throws \App\Exceptions\ApiResponseException
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();

            return static::toResponse(
                message: "$id - id li bron o'hirildi!"
            );
        } catch (ModelNotFoundException $e) {
            throw new ApiResponseException("$id - id li bron bazada tabilmadi!", 404);
        }
    }
}
