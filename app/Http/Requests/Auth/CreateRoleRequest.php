<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{

    protected $base_rule = [
        'name' => 'required|string|unique:roles|max:40:min:5',
        'permissions' => 'required|array|min:1',
        'side_nav' => 'required|json'
    ];

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
        switch ($this->method()) {
            case 'POST':
                return $this->base_rule;
            case 'PUT':
                return $this->updateRules();
        }
    }

    private function updateRules()
    {
        $this->base_rule['name'] = 'required|string|max:40:min:5|unique:roles,id,' . $this->route('updateRole');
        return $this->base_rule;
    }
}
