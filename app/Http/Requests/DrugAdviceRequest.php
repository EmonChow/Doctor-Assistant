<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugAdviceRequest extends FormRequest
{


    protected $drug_advice_rules = [
        'advice' => 'required|string|',
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
            'PUT' => $this->updateDrugAdviceRules(),
            default => $this->drug_advice_rules,
        };
    }


    private function updateDrugAdviceRules(): array
    {
        $this->drug_advice_rules['advice'] = 'required|string|max:40|min:5|unique:drug_advice,id,' . $this->route('drug-advices');
        return $this->drug_advice_rules;
    }
}
