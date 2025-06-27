<?php

namespace App\Actions\Auth;

use App\Dto\Auth\RegisterDto;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class RegisterAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\Auth\RegisterDto $dto
     * @return JsonResponse
     */
    public function __invoke(RegisterDto $dto): JsonResponse
    {
        $data = [
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'phone' => $dto->phone,
            'password' => $dto->password,
        ];

        User::create($data);

        return static::toResponse(
            message: 'User registred!'
        );
    }
}
