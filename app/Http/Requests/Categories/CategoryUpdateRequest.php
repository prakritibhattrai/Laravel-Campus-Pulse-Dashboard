<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'slug' => 'unique:categories,slug,'.$this->id,
            'status' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:categories,id',
            'order' => 'nullable|numeric',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable'
        ];
    }
}
