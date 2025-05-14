<?php

namespace App\Actions\Book;


use App\Dto\Book\UpdateDto;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class UpdateAction
{
    use ResponseTrait;

    public function __invoke(int $id, UpdateDto $dto): JsonResponse
    {
        try {
            $book = Book::findOrFail($id);

            $data = [
                'title' => $dto->title,
                'author' => $dto->author,
                'description' => $dto->description,
                'cover_image' => $dto->cover_image,
                'available_copies' => $dto->available_copies,
            ];

            $book->update($data);

            return static::toResponse(
                message: "Kita'p jan'alandi!"
            );
        } catch (ModelNotFoundException $e) {
            // TODO ApiResponse jaratiw
            throw new Exception("Qatelik");
            // throw new ApiResponseException("Category not found", 404);
        }
    }
}
