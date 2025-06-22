<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class BookingController extends Controller
{

    #[OA\Get(
        path: '/api/bookings',
        description: "All Booking",
        tags: ["Booking"],
        summary: "All Booking",
        security: [['sanctum' => []]]
    )]
    #[OA\Response(response: 200, description: 'Booking list')]
    #[OA\Response(response: 401, description: 'Not allowed')]
    #[OA\Response(response: 404, description: "Booking not found")]
    public function index()
    {
        //
    }

    #[OA\Get(path: '/api/bookings/{id}', tags: ["Booking"], summary: "Booking by id", security: [['sanctum' => []]])]
    #[OA\Parameter(name: "id", in: "path", required: true, description: "Booking id", example: 1)]
    #[OA\Response(response: 200, description: 'Booking by id')]
    #[OA\Response(response: 401, description: 'Unauthenticated')]
    #[OA\Response(response: 404, description: "Booking not found")]
    public function show()
    {
        //
    }

    #[OA\Post(
        path: '/api/bookings/create',
        tags: ["Booking"],
        summary: "Create booking",
        security: [['sanctum' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                required: [
                    "book_id",
                ],
                properties: [
                    new OA\Property(property: "book_id", type: "integer", example: 1),
                ]
            ),
        )
    )]
    #[OA\Response(response: 200, description: 'Booking created successfully')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Server error')]
    public function create()
    {
        //
    }

    #[OA\Post(
        path: '/api/bookings/update/{id}',
        tags: ["Booking"],
        summary: "Create booking",
        security: [['sanctum' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(
                required: ["book_id"],
                properties: [
                    new OA\Property(property: "book_id", type: "integer", example: 1),
                    new OA\Property(property: "status", type: "string", example: "returned"),
                    new OA\Property(property: "_method", type: "string", enum: ["PUT"], example: "PUT", nullable: false),
                ]
            ),
        )
    )]
    #[OA\Response(response: 200, description: 'Booking updated successfully')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Server error')]
    #[OA\Parameter(name: "id", in: "path", required: true, description: "Booking id", example: 1)]
    public function update()
    {
        //
    }

    #[OA\Delete(
        path: "/api/bookings/delete/{id}",
        summary: "Booking delete",
        tags: ["Booking"],
        security: [["sanctum" => []]],
    )]
    #[OA\Response(response: 200, description: "Booking deleted successfully")]
    #[OA\Response(response: 401, description: "Not allowed")]
    #[OA\Response(response: 404, description: "Booking not found")]
    #[OA\Parameter(name: "id", in: "path", required: true, description: "Booking id", example: 1)]
    public function delete()
    {
        //
    }
}
