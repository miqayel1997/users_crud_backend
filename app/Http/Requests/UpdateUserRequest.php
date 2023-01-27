<?php

namespace App\Http\Requests;

use App\Dto\UpdateUserDto;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::query()->where('id', '=', $this->route('id'))->exists();
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique(User::class, 'email')->ignore($this->route('id'))
            ],
            'name' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
        ];
    }

    public function toDto(): UpdateUserDto
    {
        return new UpdateUserDto(
            $this->route('id'),
            $this->get('email'),
            $this->get('name'),
            $this->get('phone'),
        );
    }
}
