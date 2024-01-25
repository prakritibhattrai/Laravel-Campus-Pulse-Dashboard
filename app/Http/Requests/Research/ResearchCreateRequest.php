<?php

namespace App\Http\Requests\Research;

use Illuminate\Foundation\Http\FormRequest;

class ResearchCreateRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category_id' => 'required|exists:research_categories,id',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif'
        ];
    }
}
