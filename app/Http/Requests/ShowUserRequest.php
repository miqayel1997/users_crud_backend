<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::query()->where('id', '=', $this->route('id'))->exists();
    }

    public function rules(): array
    {
        return [];
    }
}
