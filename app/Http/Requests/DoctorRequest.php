<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    protected $doctor_rules = [
        'title' => 'required|string|min:2|max:30',
        'photo' => 'sometimes|string',
        'name' => 'required|string|min:2|max:200',
        'email' => 'required|email|unique:users',
        'phone' => 'required|string|unique:users',
        'address' => 'sometimes|string|min:5|max:200',
        'password' => 'required|string|min:6|max:40',
        'degrees' => 'sometimes|array|min:1',
        'department_id' => 'required|number',
        'degrees.*.title' => 'required|string|min:2|max:50',
        'degrees.*.description' => 'sometimes|string|min:2|max:500',
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'PUT' => $this->updateDoctorRules(),
            default => $this->doctor_rules,
        };
    }

    private function updateDoctorRules(): array
    {
        $this->doctor_rules['email'] = 'required|email|unique:doctors,id,' . $this->route('doctor');
        $this->doctor_rules['phone'] = 'required|string|unique:doctors,id,' . $this->route('doctor');
        return $this->doctor_rules;
    }
}
