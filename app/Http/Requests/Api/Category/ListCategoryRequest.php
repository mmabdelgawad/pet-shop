<?php

namespace App\Http\Requests\Api\Category;

use App\Rules\CheckTableColumn;
use Illuminate\Foundation\Http\FormRequest;

class ListCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'limit' => ['nullable', 'integer', 'max:30'],
            'sortBy' => ['nullable', new CheckTableColumn('categories')],
            'sort' => ['required_with:sortBy', 'in:asc,desc'],
        ];
    }
}
