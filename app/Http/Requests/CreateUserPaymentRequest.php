<?php

namespace App\Http\Requests;

use App\Dto\CreateUserPaymentDto;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return User::query()->where('id', '=', $this->route('id'))->exists();
    }

    public function rules(): array
    {
        return [
            'amount' => ['required', 'integer', 'min:1'],
        ];
    }

    public function toDto(): CreateUserPaymentDto
    {
        return new CreateUserPaymentDto(
            $this->route('id'),
            $this->get('amount'),
        );
    }
}
