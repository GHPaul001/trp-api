<?php

namespace App\Http\Traits;

use App\Http\Filters\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
  public function scopeFilter($query, QueryFilters $filters): Builder
  {
    return $filters->apply($query);
  }
}
