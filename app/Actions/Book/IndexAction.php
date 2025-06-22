<?php

namespace App\Actions\Book;

use App\Actions\Traits\CacheTrait;
use App\Http\Resources\BookCollection;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class IndexAction
{
    use ResponseTrait, CacheTrait;

    /**
     * Summary of __invoke
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $data = $this->remember('books', function () {
            return Book::paginate(10);
        });

        return static::toResponse(
            message: "Book list",
            data: new BookCollection($data),
        );
    }
}
