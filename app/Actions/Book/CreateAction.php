<?php

namespace App\Actions\Book;

use App\Dto\Book\CreateDto;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;


class CreateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\Core\v1\Comment\CreateDto $dto
     * @return JsonResponse
     */
    public function __invoke(CreateDto $dto): JsonResponse
    {
        Book::create([
            'title' => $dto->title,
            'author' => $dto->author,
            'description' => $dto->description,
            'cover_image' => $dto->cover_image,
            'available_copies' => $dto->available_copies,
        ]);

        return static::toResponse(
            message: 'Book created!'
        );
    }
}
