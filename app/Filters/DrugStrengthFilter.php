<?php

namespace App\Filters;

use LaravelLegends\EloquentFilter\Filters\ModelFilter;

class DrugStrengthFilter extends ModelFilter
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
            'strength' => ['contains', 'starts_with'],
        ];
    }
}
