<?php

namespace App\Actions\Booking;

use App\Dto\Booking\CreateDto;
use App\Models\Booking;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class CreateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\Booking\CreateDto $dto
     * @return JsonResponse
     */
    public function __invoke(CreateDto $dto): JsonResponse
    {
        $data = [
            'user_id' => $dto->userId,
            'book_id' => $dto->bookId,
            'status' => 'active',
            'booking_date' => now(),
            // 'return_date' => now()->addWeek(),
        ];

        Booking::create($data);

        return static::toResponse(
            message: "Bron jaratildi!"
        );
    }
}
