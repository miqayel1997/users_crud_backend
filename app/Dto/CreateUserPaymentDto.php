<?php

namespace App\Dto;

class CreateUserPaymentDto
{
    public function __construct(
        public readonly int $userId,
        public readonly int $amount,
    ) {
        //
    }
}
