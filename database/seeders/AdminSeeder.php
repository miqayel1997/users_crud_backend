<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->updateOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'password' => Hash::make('12345678')
            ]
        );
    }
}
