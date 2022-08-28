<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    protected $department_rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        "department_examinations" => 'required|array',
        "department_examinations.*.name" => "required|string",
        "department_examinations.*.examination_fields" => 'required|array',
        "department_examinations.*.examination_fields.*.title" => "required|string",
        "department_examinations.*.examination_fields.*.field_type" => "required|string",
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
            'PUT' => $this->updateDepartmentRules(),
            default => $this->department_rules,
        };
    }


    private function updateDepartmentRules(): array
    {
        return $this->department_rules;
    }
}
