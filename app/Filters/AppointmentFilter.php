<?php

namespace App\Filters;

use LaravelLegends\EloquentFilter\Filters\ModelFilter;

class AppointmentFilter extends ModelFilter
{
    /**
     * The rules of filter
     * 
     * @see https://github.com/LaravelLegends/eloquent-filter#what-does-it-do
     * @return array
    */
    public function getFilterables(): array
    {
        return [
            'user_id' => ['contains', 'starts_with'],
            'schedule_id' => ['contains', 'starts_with'],
            'schedule_day_id' => ['contains', 'starts_with'],
            'schedule_day_time_id' => ['contains', 'starts_with'],
        ];
    }
}