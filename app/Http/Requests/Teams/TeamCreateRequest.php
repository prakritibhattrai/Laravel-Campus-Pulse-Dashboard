<?php

namespace App\Http\Requests\Teams;

use Illuminate\Foundation\Http\FormRequest;

class TeamCreateRequest extends FormRequest
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
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'team_type' => 'required|exists:team_types,id',
            'position' => 'required|string',
            'order' => 'nullable|numeric|min:1',
            'facebbok' => 'nullable',
            'linkedin' => 'nullable',
            'twitter' => 'nullable',
            'image' => 'nullable|mimes:jpg,bmp,png,jpeg,gif'
        ];
    }
}
