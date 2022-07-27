<?php

namespace App\Filters;

use LaravelLegends\EloquentFilter\Filters\ModelFilter;

class ScheduleFilter extends ModelFilter
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
            'id' => ['exact', 'not_equal'],
            'title' => ['contains', 'starts_with'],
            'address' => ['contains', 'starts_with'],
            'contact_person' => ['contains', 'starts_with'],
            'phone' => ['contains', 'starts_with'],
            'email' => ['contains', 'starts_with'],
        ];
    }
}
