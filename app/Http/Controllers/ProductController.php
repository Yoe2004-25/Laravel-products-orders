<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $products = product::query()
            ->filter($request)
            ->withCount('orders')
            ->paginate($perPage);

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = product::create($request->validated());

        return (new ProductResource($product))
        ->response()
        ->setStatusCode(201);
    }

    public function show(product $product)
    {
        return new ProductResource(
            $product->load(['orders', 'images'])->loadCount('orders')
        );
    }

    public function update(UpdateProductRequest $request, product $product)
    {
        $product->update($request->validated());

        return new ProductResource($product->fresh());
    }

    public function destroy(product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }

    public function apply_discount($amount , $percentage) // 300 for the t shirt and  percentate is 30%  
    {

        if($percentage < 0 || $percentage > 100 )
        {
            throw new \InvalidArgumentException('The percentage must be between 0 and 100.');
        }
        $resuelt = $amount - (( $amount * $percentage)/100) ;  

        return $resuelt ; 
    }



}