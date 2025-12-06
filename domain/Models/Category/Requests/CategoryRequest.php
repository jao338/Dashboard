<?php

namespace Domain\Models\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'name'    => ['text', 'max:25', 'required'],
            'icon'    => ['text', 'max:25', 'nullable'],
        ];
    }
}
