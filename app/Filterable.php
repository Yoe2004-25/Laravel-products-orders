<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filterable
{
    public function scopeFilter(Builder $query , Request $request):Builder
    {
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orwhere('description', 'LIKE', "%{$search}%");
            });
        }

        if($request->filled('price'))
        {
            $query->where('price',$request->input('price')); 
        }

        if($request->filled('min_price'))
        {
            $query->where('price' , '<'  , $request->input('min_price')); 
        }

        if($request->filled('max_price'))
        {
            $query->where('price' , '>=' , $request->input('max_price')); 
        }

        $sort = $request->input('sort', 'created_at');
        $direction = in_array($request->input('direction'), ['asc', 'desc'])? $request->input('direction'):'desc';
        
        $allowedSorts = ['name', 'price', 'created_at', 'updated_at'];
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        }
        
        return $query ; 
    }
}