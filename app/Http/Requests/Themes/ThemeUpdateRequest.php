<?php

namespace App\Http\Requests\Themes;

use Illuminate\Foundation\Http\FormRequest;

class ThemeUpdateRequest extends FormRequest
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
            'logo' => 'nullable',
            'footer_logo' => 'nullable',
            'favicon' => 'nullable',
            'logo_height' => 'nullable',
            'logo_width' => 'nullable',
            'google_map' => 'nullable'
        ];
    }
}
