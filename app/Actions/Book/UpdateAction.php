<?php

namespace App\Actions\Book;


use App\Dto\Book\UpdateDto;
use App\Exceptions\ApiResponseException;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param int $id
     * @param \App\Dto\Book\UpdateDto $dto
     * @throws \App\Exceptions\ApiResponseException
     * @return JsonResponse
     */
    public function __invoke(int $id, UpdateDto $dto): JsonResponse
    {
        try {
            $book = Book::findOrFail($id);

            if (Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $originalFilename = $dto->coverImage->getClientOriginalName();
            $fileName = pathinfo($originalFilename, PATHINFO_FILENAME);
            $fileName = $fileName . '_' . Str::random(10) . '_' . now()->format('Y-m-d-H:i:s') . '.' . $dto->coverImage->extension();

            $path = Storage::disk('public')->putFileAs('photos', $dto->coverImage, $fileName);

            $data = [
                'title' => $dto->title,
                'author' => $dto->author,
                'description' => $dto->description,
                'cover_image' => $path,
                'available_copies' => $dto->available_copies,
            ];

            $book->update($data);

            return static::toResponse(
                message: "Kita'p jan'alandi!"
            );
        } catch (ModelNotFoundException $e) {
            throw new ApiResponseException("$id - id li kita'p bazada tabilmadi!", 404);
        }
    }
}
