<?php

namespace App\Http\Requests\Levels;

use Illuminate\Foundation\Http\FormRequest;

class LevelCreateRequest extends FormRequest
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
            'title'=>'required',
            'description'=>'required',
            'image'=>'sometimes|mimes:png,jpg,jpeg,gif'
        ];
    }
}
