<?php

namespace App\Filters;

use LaravelLegends\EloquentFilter\Filters\ModelFilter;

class DoctorFilter extends ModelFilter
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
            'description' => ['contains', 'starts_with'],
        ];
    }
}