<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugRequest extends FormRequest
{

    protected array $drugs_rules = [
        'trade_name' => 'required|string|unique:drugs|max:40|min:5',
        'generic_name' => 'required|string|max:40|min:5',
        'note' => 'sometimes|string',
        'additional_advice' => 'sometimes|string',
        'warning' => 'sometimes|string',
        'side_effect' => 'sometimes|string',
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
            'PUT' => $this->updateDrugsRules(),
            default => $this->drugs_rules,
        };
    }

    /**
     * Get the validation rules for update under put method
     *
     * @return array|string[]
     */
    private function updateDrugsRules(): array
    {
        $this->drugs_rules['trade_name'] = 'required|string|unique:drugs|max:40|min:5' . $this->route('drugs');
        return $this->drugs_rules;
    }
}
