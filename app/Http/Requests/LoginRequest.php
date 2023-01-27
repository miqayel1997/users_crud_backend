<?php

namespace App\Http\Requests;

use App\Dto\LoginDto;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ];
    }

    public function toDto(): LoginDto
    {
        return new LoginDto($this->get('email'), $this->get('password'));
    }
}
