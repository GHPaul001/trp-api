<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilters
{
  protected Request $request;
  protected Builder $builder;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function apply(Builder $builder): Builder
  {
    $this->builder = $builder;

    foreach ($this->filters() as $name => $value) {
      if (!method_exists($this, $name)) {
        continue;
      }

      if ($value !== '') {
        $this->$name($value);
      } else {
        $this->$name();
      }
    }

    return $this->builder;
  }

  public function filters(): array
  {
    return array_filter($this->request->all(), static function($value) {
        return ($value !== null && $value !== '');
    });
  }
}
