<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\order;
use Illuminate\Http\Request;
use App\Filterable;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $orders = order::query()->filter($request)->withCount('products')->paginate($perPage);

        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = order::create($request->validated());

     
        if ($request->filled('products')) {
            $order->products()->attach($request->input('products'));
        }

        return (new OrderResource($order->load('products'))) ->response()->setStatusCode(201); 
    }

    public function show(order $order)
    {
        return new OrderResource($order->load(['products', 'images'])->loadCount('products'));
    }

    public function update(UpdateOrderRequest $request, order $order)
    {
        $order->update($request->validated());     
        return new OrderResource($order->load('products'));
    }

    public function destroy(order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully',], 200);
    }
}