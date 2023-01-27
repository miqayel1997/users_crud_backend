<?php

namespace App\Dto;

class CreateUserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly string $phone,
    ) {
        //
    }
}
