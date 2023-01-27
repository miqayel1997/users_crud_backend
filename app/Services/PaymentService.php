<?php

namespace App\Services;

use App\Dto\CreateUserPaymentDto;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

class PaymentService
{
    public function list(int $userId): Collection
    {
        return Payment::query()->where('user_id', '=', $userId)->get();
    }

    public function create(CreateUserPaymentDto $request): int
    {
        $payment = Payment::query()->create([
            'user_id' => $request->userId,
            'amount' => $request->amount,
        ]);

        return $payment->id;
    }
}
