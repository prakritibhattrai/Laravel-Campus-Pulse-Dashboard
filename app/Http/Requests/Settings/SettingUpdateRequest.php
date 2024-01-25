<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'site_name' => 'nullable',
            'site_title' => 'nullable',
            'site_url' => 'nullable',
            'copyright' => 'nullable',
            'address' => 'nullable',
            'contact_number' => 'nullable',
            'email' => 'nullable|email',
            'mail_driver' => 'nullable',
            'mail_host' => 'nullable',
            'mail_username' => 'nullable',
            'mail_password' => 'nullable',
            'mail_port' => 'nullable',
            'mail_from' => 'nullable|email',
            'mail_encryption' => 'nullable',
            'maintenance' => 'nullable',
            'cache' => 'nullable',
            'use_ssl' => 'nullable',
            'app_debug' => 'nullable',
            'google_recaptcha' => 'nullable',
            'minify' => 'nullable',
            'timezone' => 'nullable'
        ];
    }
}
