<?php

namespace App\Dto;

class UpdateUserDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly string $name,
        public readonly string $phone,
    ) {
        //
    }
}
