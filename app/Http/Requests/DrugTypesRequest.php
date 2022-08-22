<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugTypesRequest extends FormRequest
{
    protected $drug_type_rules = [
        'type' => 'required|string|',
        'status' => 'required|boolean|',
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
            'PUT' => $this->updateDrugTypeRules(),
            default => $this->drug_type_rules,
        };
    }

    private function updateDrugTypeRules(): array
    {
        return $this->drug_type_rules;
    }
}
