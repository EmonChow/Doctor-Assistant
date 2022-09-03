<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    protected $patient_rules = [
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
