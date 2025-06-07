<?php

namespace App\Dto\Book;

use App\Http\Requests\Book\UpdateRequest;
use Illuminate\Http\UploadedFile;

readonly class UpdateDto
{
    public function __construct(
        // public string $id,
        public string $title,
        public string $author,
        public ?string $description,
        public UploadedFile $coverImage,
        public int $available_copies,
    ) {
    }

    /**
     * Summary of from
     * @param \App\Http\Requests\Book\UpdateRequest $request
     * @return UpdateDto
     */
    public static function from(UpdateRequest $request): self
    {
        return new self(
            // id: $request->get('id'),
            title: $request->get('title'),
            author: $request->get('author'),
            description: $request->get('description'),
            coverImage: $request->file('cover_image'),
            available_copies: $request->get('available_copies'),
        );
    }
}
