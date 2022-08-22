<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    protected $patient_rules = [
        'title' => 'required|string|min:2|max:30',
        'photo' => 'sometimes|string',
        'name' => 'required|string|min:2|max:200',
        'email' => 'required|email|unique:users',
        'phone' => 'required|string|unique:users',
        'address' => 'sometimes|string|min:5|max:200',
        'password' => 'required|string|min:6|max:40',
        'height' => 'required|integer|',
        'weight' => 'required|integer|',
        'birth_date' => 'required|date:format:Y-m-d',
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
            'PUT' => $this->updatePatientRules(),
            default => $this->patient_rules,
        };
    }

    private function updatePatientRules(): array
    {
        return $this->patient_rules;
    }
}
