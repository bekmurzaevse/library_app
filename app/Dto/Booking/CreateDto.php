<?php

namespace App\Dto\Booking;

use App\Http\Requests\Booking\CreateRequest;

readonly class CreateDto
{
    public function __construct(
        public int $bookId,
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
            bookId: $request->get('book_id'),
        );
    }
}
