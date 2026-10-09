<?php

namespace App\Models;

use App\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\order; 
use App\Models\images ; 
class product extends Model
{
    use HasFactory ; 

    use SoftDeletes ; 

    use Filterable ; 

    protected $fillable = [
        'name', 
        'price',
        'description',
    ]; 

    protected $casts = [
        'price'=>'decimal',
    ];

    public function orders()
    {
        return $this->belongsToMany(order::class, 'product_order') ->withPivot(['thedayoftheprocess', 'quantity'])
        ->withTimestamps();
    }


    public function images()
    {
        return $this->morphMany(images::class,'imageable')->orderBy('order');
    } 
}