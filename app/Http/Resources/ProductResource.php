<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'name' => $this->name, 
            'price'=> $this->price,
            'description' => $this->description, 
            'orders'=>OrderResource::collection($this->whenLoaded('orders')),
            'orders_count'=>OrderResource::collection($this->whenLoaded('orders')),
             'created_at'=>$this->created_at?->format('H:M:S'), 
            'updated_at'=>$this->updated_at?->format('H:M:S'),
       ]; 
    }
}