<?php

namespace App\Dto\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Traits\ResponseTrait;

readonly class LoginDto
{
    public function __construct(
        public string $phone,
        public string $password
    ) {
    }


    public static function from(LoginRequest $request): self
    {
        return new self(
            phone: $request->get('phone'),
            password: $request->get('password')
        );
    }
}
