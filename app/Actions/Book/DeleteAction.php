<?php

namespace App\Actions\Book;

use App\Actions\Traits\CacheTrait;
use App\Exceptions\ApiResponseException;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class DeleteAction
{
    use ResponseTrait, CacheTrait;

    /**
     * Summary of __invoke
     * @param int $id
     * @throws \Exception
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();

            return static::toResponse(
                message: "$id - id li kita'p o'hirildi!"
            );
        } catch (ModelNotFoundException $e) {
            throw new ApiResponseException("$id - id li kita'p bazada tabilmadi!", 404);
        }
    }
}
