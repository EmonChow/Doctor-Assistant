<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    protected $appointment_rules = [
        'user_id' => 'required|integer:appointments',
        'schedule_id' => 'required|integer:appointments',
        'schedule_day_id' => 'required|integer:appointments',
        'schedule_day_time_id' => 'required|integer|unique:appointments',
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
    public function rules()
    {
        return match ($this->method()) {
            'PUT' => $this->updateAppointmentRules(),
            default => $this->appointment_rules,
        };
    }

    private function updateAppointmentRules(): array
    {
        $this->appointment_rules['schedule_day_time_id'] = 'required|integer|unique:appointments,id,' . $this->route('appointment');
        return $this->appointment_rules;
    }


}
