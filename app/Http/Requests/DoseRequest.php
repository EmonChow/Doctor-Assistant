<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoseRequest extends FormRequest
{
    protected $dose_rules = [
        'dose' => 'required|string',
        'status' => 'required|boolean',

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
            'PUT' => $this->updateDoseRules(),
            default => $this->dose_rules,
        };
    }


    private function updateDoseRules(): array
    {
        return $this->dose_rules;
    }
}
