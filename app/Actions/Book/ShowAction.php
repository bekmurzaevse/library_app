<?php

namespace App\Actions\Book;

use App\Actions\Traits\CacheTrait;
use App\Exceptions\ApiResponseException;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ShowAction
{
    use ResponseTrait, CacheTrait;

    /**
     * Summary of __invoke
     * @param int $id
     * @throws \App\Exceptions\ApiResponseException
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        try {
            $data = $this->remember('books:show:' . $id, function () use ($id) {
                return Book::findOrFail($id);
            });

            return static::toResponse(
                message: "Kita'p",
                data:  new BookResource($data),
            );
        } catch (ModelNotFoundException $ex) {
            throw new ApiResponseException("$id - id li kita'p bazada tabilmadi!", 404);
        }
    }
}
