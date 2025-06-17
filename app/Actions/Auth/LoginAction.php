<?php

namespace App\Actions\Auth;

use App\Dto\Auth\LoginDto;
use App\Exceptions\ApiResponseException;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    use ResponseTrait;

    /**
     * Summary of __invoke
     * @param \App\Dto\Auth\LoginDto $dto
     * @throws \App\Exceptions\ApiResponseException
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return JsonResponse
     */
    public function __invoke(LoginDto $dto): JsonResponse
    {
        try {
            $user = User::where('phone', $dto->phone)->firstOrFail();

            if (! Hash::check($dto->password, $user->password)) {
                throw new ApiResponseException('Kiritilgen login yaki parol duris emes', 401);
            }

            auth()->login($user);

            $accessTokenExpiration = now()->addMinutes(60);
            $refreshTokenExpiration = now()->addDays(30);

            $accessToken = auth()->user()->createToken(
                name: 'access token',
                abilities: ['access-token'],
                expiresAt: $accessTokenExpiration
            );

            $refreshToken = auth()->user()->createToken(
                name: 'refresh token',
                abilities: ['refresh-token'],
                expiresAt: $refreshTokenExpiration
            );

            return static::toResponse(
                message: 'Login successful',
                data: [
                    'access_token' => $accessToken->plainTextToken,
                    'refresh_token' => $refreshToken->plainTextToken,
                    'at_expired_at' => $accessTokenExpiration->format('Y-m-d H:i:s'),
                    'rf_expired_at' => $refreshTokenExpiration->format('Y-m-d H:i:s'),
                ]
            );
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('User Not FOund', 404);
        }
    }
}
