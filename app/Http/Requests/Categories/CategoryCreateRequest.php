<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'nullable|unique:categories,slug',
            'status' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:categories,id',
            'order' => 'nullable|numeric',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable'
        ];
    }
}
