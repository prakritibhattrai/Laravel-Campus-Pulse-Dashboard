<?php

namespace App\Http\Requests\Publications;

use Illuminate\Foundation\Http\FormRequest;

class PublicationCreateRequest extends FormRequest
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
            'category_id' => 'required|exists:publication_categories,id',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif',
            'file' => 'sometimes|mimes:ppt,pptx,doc,xls,docx,pdf,txt,xlsx'
        ];
    }
}
