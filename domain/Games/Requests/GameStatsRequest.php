<?php

namespace Domain\Games\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameStatsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The game ID is required.',
            'id.numeric' => 'The game ID must be a valid number.'
        ];
    }
}
