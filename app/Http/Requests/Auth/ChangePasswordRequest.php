<?php

namespace App\Http\Requests\Auth;

use App\Rules\MatchCurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', new MatchCurrentPassword()],
            'password' => 'required|min:6|max:40',
            'password_confirmation' => 'required|min:6|max:40'
        ];
    }
}
