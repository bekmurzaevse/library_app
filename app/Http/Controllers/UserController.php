<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Dto\Auth\LoginDto;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        return $action(LoginDto::from($request));
    }

    public function logout(LogoutAction $action)
    {
        return $action();
    }
}
