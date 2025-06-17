<?php

namespace App\Actions\Booking;

use App\Actions\Traits\CacheTrait;
use App\Exceptions\ApiResponseException;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookResource;
use App\Models\Booking;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ShowAction
{
    use ResponseTrait, CacheTrait;

    /**
     * Summary of __invoke
     * @param int $id
     * @throws \App\Exceptions\ApiResponseException
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            $booking = $this->remember('bookings:show:' . $id, function () use ($id) {
                return Booking::findOrFail($id);
            });

            return static::toResponse(
                message: "Bron",
                data:  new BookingResource($booking),
            );
        } catch (ModelNotFoundException $ex) {
            throw new ApiResponseException("$id - id li bron bazada tabilmadi!", 404);
        }
    }
}
