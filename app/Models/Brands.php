<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Brands extends Model
{
    use HasFactory,  Filterable;

    protected $fillable = ['name','logo','slug'.'meta_title','meta_description'];

}