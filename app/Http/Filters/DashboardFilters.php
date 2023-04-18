<?php

namespace App\Http\Filters;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\BaseFilters;


class DashboardFilters extends BaseFilters
{ 

    public function id($value): Builder
    {
        return $this->builder->where('id', $value);
    }

}
