<?php

namespace App\Models;

use App\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product ;
use Illuminate\Database\Eloquent\SoftDeletes; 

class order extends Model
{
    use HasFactory ; 

    use SoftDeletes ; 

    use Filterable ; 
    protected $fillable = [
            'name' , 'details'
    ];

    protected $casts = [
        'name'=>'string', 
        'details'=>'text',
    ];

    public function products()
    {    
     return $this->belongsToMany(product::class ,'product_order')
                    ->withPivot(['thedayoftheprocess' , 'quantity'])
                    ->withTimestamps(); 
    }

    public function images()
    {
        return $this->morphMany(images::class,'imageable')->orderBy('order');
    } 
}