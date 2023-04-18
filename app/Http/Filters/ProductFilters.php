<?php

namespace App\Http\Filters;
use App\Http\Filters\BaseFilters;
use Illuminate\Database\Eloquent\Builder;


class ProductFilters extends BaseFilters
{
    protected $filters = [
        'name',
        'rating',
        'unit_price',
        'num_of_sale',
    ];

    protected function name($value)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }

    protected function rating($value)
    {
        return $this->builder->where('rating', '>=', $value);
    }

    protected function unit_price($value)
    {
        return $this->builder->where('unit_price', '<=', $value);
    }

    protected function num_of_sale($value)
    {
        return $this->builder->orderBy('num_of_sale', $value);
    }

    protected function added_by($value)
    {
        return $this->builder->where('added_by', $value);
    }

 }
