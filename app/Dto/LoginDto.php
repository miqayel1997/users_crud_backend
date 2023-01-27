<?php

namespace App\Dto;

class LoginDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
        //
    }
}
