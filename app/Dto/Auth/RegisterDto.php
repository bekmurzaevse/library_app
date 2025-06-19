<?php

namespace App\Dto\Auth;

use App\Http\Requests\Auth\RegisterRequest;

readonly class RegisterDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $phone,
        public string $password
    ) {
    }

    /**
     * Summary of from
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return RegisterDto
     */
    public static function from(RegisterRequest $request): self
    {
        return new self(
            firstName: $request->get('first_name'),
            lastName: $request->get('last_name'),
            phone: $request->get('phone'),
            password: $request->get('password')
        );
    }
}
