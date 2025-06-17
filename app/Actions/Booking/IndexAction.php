<?php

namespace App\Actions\Booking;

use App\Actions\Traits\CacheTrait;
use App\Http\Resources\BookingCollection;
use App\Models\Booking;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class IndexAction
{
    use ResponseTrait, CacheTrait;

    /**
     * Summary of __invoke
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $bookings = $this->remember('bookings', function () {
            return Booking::paginate(10);
        });

        return static::toResponse(
            message: 'Bronlar dizimi',
            data: new BookingCollection($bookings)
        );
    }
}
