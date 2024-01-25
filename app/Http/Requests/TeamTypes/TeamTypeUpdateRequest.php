<?php

namespace App\Http\Requests\TeamTypes;

use Illuminate\Foundation\Http\FormRequest;

class TeamTypeUpdateRequest extends FormRequest
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
            'slug' =>'unique:team_types,slug,' . $this->id
        ];
    }
}
