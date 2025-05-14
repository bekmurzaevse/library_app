<?php

namespace App\Actions\Book;

use App\Actions\Traits\CacheTrait;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ShowAction
{
    use ResponseTrait, CacheTrait;

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
            // TODO ApiResponse jaratriw
            throw new Exception("QATELIK");
            // throw new ApiResponseException('post not found', 404);
        }
    }
}
