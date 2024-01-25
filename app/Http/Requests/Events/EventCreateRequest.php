<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class EventCreateRequest extends FormRequest
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
            'slug' => 'required|unique:events,slug',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'veneu' => 'required',
            'fee' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'organizer' => 'required',
            'status' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif'
        ];
    }
}
