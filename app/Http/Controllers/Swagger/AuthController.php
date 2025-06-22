<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{

    #[OA\Post(
        path: '/api/auth/login',
        tags: ["Auth"],
        summary: "Login",
    )]
    #[OA\RequestBody(
        required: true,
        description: "login data",
        content: new OA\JsonContent(
            required: ["phone", "password"],
            properties: [
                new OA\Property(property: "phone", type: "string", example: "998971234567"),
                new OA\Property(property: "password", type: "string", example: "1234567"),
            ]
        )
    )]
    #[OA\Response(response: 200, description: 'Successfull')]
    #[OA\Response(response: 422, description: 'Validation error')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function login(): void
    {
        //
    }

    #[OA\Post(
        path: '/api/auth/logout',
        tags: ["Auth"],
        summary: "Logout",
        security: [['sanctum' => []]]
    )]
    #[OA\Response(response: 200, description: 'Logout')]
    #[OA\Response(response: 401, description: 'Unauthenticated')]
    #[OA\Response(response: 500, description: 'Internal server error')]
    public function logout()
    {
        //
    }

    #[OA\Post(
        path: '/api/auth/register',
        description: "Registration",
        tags: ["Auth"],
        summary: "Registration",
    )]
    #[OA\RequestBody(
        required: true,
        description: "Registration",
        content: new OA\JsonContent(
            required: ["first_name", "last_name", "phone", "password"],
            properties: [
                new OA\Property(property: "first_name", type: "string", example: "Murk"),
                new OA\Property(property: "last_name", type: "string", example: "Zuckerberg"),
                new OA\Property(property: "phone", type: "string", example: "998971234560"),
                new OA\Property(property: "password", type: "string", example: "1234567"),
            ]
        )
    )]
    #[OA\Response(response: 200, description: 'Registred!')]
    #[OA\Response(response: 401, description: 'Not allowed')]
    #[OA\Response(response: 404, description: "Not Found!")]
    public function register()
    {
        //
    }
}
