<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserAndPaymentSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(50)->create()->each(function (User $user) {
            $user->payments()->saveMany(Payment::factory()->count(10)->make());
        });
    }
}
