<?php

namespace App\Http\Filters;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\BaseFilters;


class CategoryFilters extends BaseFilters
{
    public function name($value): Builder
    {
        return $this->builder->where('name', $value);
    }

    public function id($value): Builder
    {
        return $this->builder->where('id', $value);
    }



 }
