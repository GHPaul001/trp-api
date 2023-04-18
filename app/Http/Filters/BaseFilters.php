<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class BaseFilters extends QueryFilters
{
    public function orderBy($sort): Builder
    {
        $base = explode(':', $sort);

        if (count($base) !== 2) {
            throw new \RuntimeException("Invalid order by keyword");
        }

        [$column, $type] = $base;

        if (!in_array(strtolower($type), ['desc', 'asc'])) {
            throw new \RuntimeException("Invalid order by keyword");
        }

        return $this->builder->orderBy($column, $type);
    }
}
