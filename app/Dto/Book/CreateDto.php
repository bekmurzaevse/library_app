<?php

namespace App\Dto\Book;

use App\Http\Requests\Book\CreateRequest;

readonly class CreateDto
{
    public function __construct(
        public string $title,
        public string $author,
        public ?string $description,
        public ?string $cover_image,
        public ?string $available_copies,
    ) {
    }

    public static function from(CreateRequest $request): self
    {
        return new self(
            title: $request->get('title'),
            author: $request->get('author'),
            description: $request->get('description'),
            cover_image: $request->get('cover_image'),
            available_copies: $request->get('available_copies'),
        );
    }
}
