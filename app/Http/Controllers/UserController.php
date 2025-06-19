<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterAction;
use App\Dto\Auth\LoginDto;
use App\Dto\Auth\RegisterDto;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    /**
     * Summary of login
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @param \App\Actions\Auth\LoginAction $action
     * @return JsonResponse
     */
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        return $action(LoginDto::from($request));
    }

    /**
     * Summary of logout
     * @param \App\Actions\Auth\LogoutAction $action
     * @return JsonResponse
     */
    public function logout(LogoutAction $action): JsonResponse
    {
        return $action();
    }

    /**
     * Summary of register
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @param \App\Actions\Auth\RegisterAction $action
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        return $action(RegisterDto::from($request));
    }
}
