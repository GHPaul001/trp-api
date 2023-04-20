<?php

namespace App\Models;

use App\Http\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model 
{
    use HasFactory, Filterable;

    protected $fillable = ['name','order_level','parent_id','slug'];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'categories_id', 'id');
    }

    public function clients()
    {
        return $this->belongsTo('App\Models\Clients', 'client_id', 'id')->withTrashed();
    }

    public function episode()
    {
        return $this->belongsTo('App\Models\TreatmentEpisode', 'treatment_episode_id', 'id');
    }
}