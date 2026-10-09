<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    return
       [    
            'name' => $this->name,
            'details'=>$this->details ,
            'products'=>ProductResource::collection($this->whenLoaded('products')),
            'products_counts'=>ProductResource::collection($this->whenLoaded('products')),
            'created_at'=>$this->created_at?->format('H:M:S'), 
            'updated_at'=>$this->updated_at?->format('H:M:S'),
       ];
    }   
}