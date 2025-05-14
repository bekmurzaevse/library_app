<?php

namespace App\Dto\Book;

use App\Http\Requests\Book\UpdateRequest;

readonly class UpdateDto
{
    public function __construct(
        // public string $id,
        public string $title,
        public string $author,
        public ?string $description,
        public ?string $cover_image,
        public ?string $available_copies,
    ) {
    }

    public static function from(UpdateRequest $request): self
    {
        return new self(
            // id: $request->get('id'),
            title: $request->get('title'),
            author: $request->get('author'),
            description: $request->get('description'),
            cover_image: $request->get('cover_image'),
            available_copies: $request->get('available_copies'),
        );
    }
}
