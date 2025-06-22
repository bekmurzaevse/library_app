<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

use OpenApi\Attributes as OA;

#[
    OA\Info(version: "1.0.0", description: "Library App Project Documentation", title: "Library App Documentation"),
    OA\PathItem(path: "/"),
    OA\Server(url: 'http://localhost:8000/api', description: "local server"),
    OA\SecurityScheme(securityScheme: 'sanctum', type: "apiKey", name: "Authorization", in: "header", description: "Token kiritilgende 'Bearer {token}' formatinan paydalanin'"),
]
class BaseController extends Controller
{
    //
}
