<?php

namespace App\Filters;

use LaravelLegends\EloquentFilter\Filters\ModelFilter;

class DrugAdviceFilter extends ModelFilter
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
            'advice' => ['contains', 'starts_with'],
        ];
    }
}