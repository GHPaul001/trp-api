<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    use HasFactory,  Filterable;

    protected $fillable = ['name','added_by','user_id','category_id','brand_id','unit_price','slug'];

    protected $hidden = [ 'created_at', 'updated_at'];

}