<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class BookController extends Controller
{

    #[OA\Get(
        path: '/api/books',
        description: "All Books",
        tags: ["Book"],
        summary: "All Books",
        security: [['sanctum' => []]]
    )]
    #[OA\Response(response: 200, description: 'Book list')]
    #[OA\Response(response: 401, description: 'Not allowed')]
    #[OA\Response(response: 404, description: "Book not found")]
    public function index(): void
    {
        //
    }

    #[OA\Post(
        path: '/api/books/create',
        tags: ["Book"],
        summary: "Create book",
        security: [['sanctum' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                required: [
                    "title", "author", "available_copies",
                ],
                properties: [
                    new OA\Property(property: "title", type: "string", example: "title"),
                    new OA\Property(property: "author", type: "string", example: "author"),
                    new OA\Property(property: "available_copies", type: "integer", example: 1),

                    new OA\Property(
                        property: "cover_image",
                        type: "string",
                        format: "binary"
                    )
                ]
            ),
        )
    )]
    #[OA\Response(response: 200, description: 'Book created successfully')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Server error')]
    public function store(): void
    {
        //
    }

    #[OA\Get(path: '/api/books/{id}', tags: ["Book"], summary: "Book by id", security: [['sanctum' => []]])]
    #[OA\Parameter(name: "id", in: "path", required: true, description: "Book id", example: 1)]
    #[OA\Response(response: 200, description: 'Book by id')]
    #[OA\Response(response: 401, description: 'Unauthenticated')]
    #[OA\Response(response: 404, description: "Book not found")]
    public function show(): void
    {
        //
    }

    #[OA\Post(
        path: '/api/books/update/{id}',
        tags: ["Book"],
        summary: "Create book",
        security: [['sanctum' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                required: [],
                properties: [
                    new OA\Property(property: "title", type: "string", example: "new title"),
                    new OA\Property(property: "author", type: "string", example: "new author"),
                    new OA\Property(property: "available_copies", type: "integer", example: 1),
                    new OA\Property(property: "_method", type: "string", enum: ["PUT"], example: "PUT", nullable: false),

                    new OA\Property(
                        property: "cover_image",
                        type: "string",
                        format: "binary"
                    )
                ]
            ),
        )
    )]
    #[OA\Response(response: 200, description: 'Book updated successfully')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Server error')]
    #[OA\Parameter(name: "id", in: "path", required: true, description: "Book id", example: 1)]
    public function update(): void
    {
        //
    }

    #[OA\Delete(
        path: "/api/books/delete/{id}",
        summary: "Book delete",
        tags: ["Book"],
        security: [["sanctum" => []]],
    )]
    #[OA\Response(response: 200, description: "Book deleted successfully")]
    #[OA\Response(response: 401, description: "Not allowed")]
    #[OA\Response(response: 404, description: "Book not found")]
    #[OA\Parameter(name: "id", in: "path", required: true, description: "Book id", example: 1)]
    public function delete(): void
    {
        //
    }
}
