<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugStrengthRequest extends FormRequest
{
    protected $strength_rules = [
        'strength' => 'required|string|',
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
            'PUT' => $this->updateStrengthRules(),
            default => $this->strength_rules,
        };
    }

    private function updateStrengthRules(): array
    {
        $this->strength_rules['strength'] = 'required|string|max:40|min:5|unique:drug_strengths,id,' . $this->route('drug-strength');
        return $this->strength_rules;
    }
}
