<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{

    protected $schedule_rules = [
        'title' => 'required|string:schedules',
        'address' => 'required|string:schedules',
        'contact_person' => 'required|string:schedules',
        'phone' => 'required|string:schedules',
        'email' => 'required|email',
        "days" => 'required|array|min:1|max:7',
        "days.*.day" => "required|string",
        "days.*.start_time" => "required|date_format:H:i",
        "days.*.end_time" => "required|date_format:H:i",
        "days.*.time_slot" => "required|numeric|min:1"
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
            'PUT' => $this->updateScheduleRules(),
            default => $this->schedule_rules,
        };
    }

    private function updateScheduleRules(): array
    {
        $this->schedule_rules['title'] = 'required|string:schedules,id,' . $this->route('schedules');
        $this->schedule_rules['address'] = 'required|string:schedules,id,' . $this->route('schedules');
        $this->schedule_rules['contact_person'] = 'required|string:schedules,id,' . $this->route('schedules');
        $this->schedule_rules['phone'] = 'required|string:schedules,id,' . $this->route('schedules');
        $this->schedule_rules['email'] = 'required|email:schedules,id,' . $this->route('schedules');
        return $this->schedule_rules;
    }
}
