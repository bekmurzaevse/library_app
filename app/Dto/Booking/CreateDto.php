<?php

namespace App\Dto\Booking;

use App\Http\Requests\Booking\CreateRequest;

readonly class CreateDto
{
    public function __construct(
        // public int $userId,
        public int $bookId,
        // public ?string $returnDate,
    ) {
    }
    /**
     * Summary of from
     * @param \App\Http\Requests\Booking\CreateRequest $request
     * @return CreateDto
     */
    public static function from(CreateRequest $request): self
    {
        return new self(
            // userId: $request->get('user_id'),
            bookId: $request->get('book_id'),
            // returnDate: $request->get('return_date'),
        );
    }
}
