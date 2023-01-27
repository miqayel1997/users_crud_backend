<?php

namespace App\Http\Requests;

use App\Dto\CreateUserDto;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'name' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
        ];
    }

    public function toDto(): CreateUserDto
    {
        return new CreateUserDto(
            $this->get('email'),
            $this->get('name'),
            $this->get('phone'),
        );
    }
}
