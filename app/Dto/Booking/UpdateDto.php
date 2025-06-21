<?php

namespace App\Dto\Booking;

use App\Http\Requests\Booking\UpdateRequest;

readonly class UpdateDto
{
    public function __construct(
        public int $bookId,
        public ?string $status,
    ) {
    }

    /**
     * Summary of from
     * @param \App\Http\Requests\Booking\UpdateRequest $request
     * @return UpdateDto
     */
    public static function from(UpdateRequest $request): self
    {
        return new self(
            bookId: $request->get('book_id'),
            status: $request->get('status'),
        );
    }
}
