<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait MultiFilterable
{
  public function scopeMultiFilter($query, $filter, $values): Builder
  {
     return !is_array($values) ? $query->where($filter , $values) : $query->whereIn($filter , $values);
  }
}
