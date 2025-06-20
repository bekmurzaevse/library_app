<?php

namespace App\Actions\Book;

use App\Dto\Book\CreateDto;
use App\Models\Book;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\Book\CreateDto $dto
     * @return JsonResponse
     */
    public function __invoke(CreateDto $dto): JsonResponse
    {
        $photo = $dto->coverImage;
        $path = null;
        if ($photo) {
            $originalFilename = $photo->getClientOriginalName();
            $fileName = pathinfo($originalFilename, PATHINFO_FILENAME);
            $fileName = $fileName . '_' . Str::random(10) . '_' . now()->format('Y-m-d-H:i:s') . '.' . $photo->extension();

            $path = Storage::disk('public')->putFileAs('photos', $photo, $fileName);
        }

        Book::create([
            'title' => $dto->title,
            'author' => $dto->author,
            'description' => $dto->description,
            'cover_image' => $path,
            'available_copies' => $dto->available_copies,
        ]);

        return static::toResponse(
            message: 'Book created!'
        );
    }
}
