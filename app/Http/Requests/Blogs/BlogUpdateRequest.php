<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'slug' => 'unique:blogs,slug,'.$this->id,
            'summary' => 'nullable',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,gif',
            'tags' => 'nullable'
        ];
    }
}
