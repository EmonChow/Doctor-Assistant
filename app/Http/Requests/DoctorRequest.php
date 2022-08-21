<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:30',
            'photo' => 'sometimes|string',
            'name' => 'required|string|min:2|max:200',
            'email' => 'required|email|unique',
            'phone' => 'required|string|unique',
            'address' => 'sometimes|string|min:5|max:200',
            'password' => 'required|confirmed|string|min:6|max:40',
            'degrees' => 'sometimes|array|min:1',
            'degrees.*.title' => 'required|string|min:2|max:50',
            'degrees.*.description' => 'sometimes|string|min:2|max:500',
        ];
    }
}
