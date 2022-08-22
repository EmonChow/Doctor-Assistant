<?php

namespace App\Filters;

use LaravelLegends\EloquentFilter\Filters\ModelFilter;

class PatientFilter extends ModelFilter
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
            'height' => ['contains', 'starts_with'],
            'weight' => ['contains', 'starts_with'],
            'birth_date' => ['contains', 'starts_with'],
        ];
    }
}