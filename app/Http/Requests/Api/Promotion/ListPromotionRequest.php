<?php

namespace App\Http\Requests\Api\Promotion;

use App\Rules\CheckTableColumn;
use Illuminate\Foundation\Http\FormRequest;

class ListPromotionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'limit' => ['nullable', 'integer', 'max:20'],
            'sortBy' => ['nullable', new CheckTableColumn('promotions')],
            'sort' => ['required_with:sortBy', 'in:asc,desc'],
            'valid' => ['nullable', 'boolean'],
        ];
    }
}
