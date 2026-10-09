<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class images extends Model
{
    use HasFactory ;  
    use SoftDeletes ; 
    

    protected $fillable =[
        'url' , 'alt' , 'order'  
    ];

    public function imageable()
    {
        return $this->morphTo() ; 
    }
}