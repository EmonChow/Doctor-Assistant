<?php

namespace App\Filters;

use LaravelLegends\EloquentFilter\Filters\ModelFilter;

class DoseFilter extends ModelFilter
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
            'dose'=>['contains', 'starts_with'],
        ];
    }
}