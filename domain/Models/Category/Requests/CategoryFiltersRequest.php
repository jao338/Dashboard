<?php

namespace Domain\Models\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFiltersRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'name'    => ['text', 'max:255'],
        ];
    }
}
