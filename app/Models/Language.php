<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Language extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, Filterable;

    protected $fillable = [];
}