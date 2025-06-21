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

    /**
     * Summary of from
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return LoginDto
     */
    public static function from(LoginRequest $request): self
    {
        return new self(
            phone: $request->get('phone'),
            password: $request->get('password')
        );
    }
}
