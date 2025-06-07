<?php

namespace App\Dto\Book;

use App\Http\Requests\Book\CreateRequest;
use Illuminate\Http\UploadedFile;

readonly class CreateDto
{
    public function __construct(
        public string $title,
        public string $author,
        public ?string $description,
        public UploadedFile $coverImage,
        public int $available_copies,
    ) {
    }

    /**
     * Summary of from
     * @param \App\Http\Requests\Book\CreateRequest $request
     * @return CreateDto
     */
    public static function from(CreateRequest $request): self
    {
        return new self(
            title: $request->get('title'),
            author: $request->get('author'),
            description: $request->get('description'),
            coverImage: $request->file('cover_image'),
            available_copies: $request->get('available_copies'),
        );
    }
}
