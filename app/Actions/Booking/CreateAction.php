<?php

namespace App\Actions\Booking;

use App\Dto\Booking\CreateDto;
use App\Exceptions\ApiResponseException;
use App\Models\Book;
use App\Models\Booking;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class CreateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\Booking\CreateDto $dto
     * @throws \App\Exceptions\ApiResponseException
     * @return JsonResponse
     */
    public function __invoke(CreateDto $dto): JsonResponse
    {
        try {
            $book = Book::findOrFail($dto->bookId);

            if ($book->available_copies < 1) {
                return static::toResponse(
                    code: 422,
                    message: "bul kit'ap tin' ha'mmesi bos emes!"
                );
            }

            $data = [
                'user_id' => auth()->user()->id,
                'book_id' => $dto->bookId,
                'status' => 'active',
                'booking_date' => now(),
            ];

            Booking::create($data);

            $book->decrement('available_copies');

            return static::toResponse(
                message: "Bron jaratildi!"
            );
        } catch (ModelNotFoundException $ex) {
            throw new ApiResponseException("$dto->bookId - id li kita'p bazada tabilmadi!", 404);
        }
    }
}
