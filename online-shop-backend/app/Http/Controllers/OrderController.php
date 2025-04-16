<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user'])->where('user_id', auth()->id())->get();
        return OrderResource::collection($orders);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
    
        $request->merge([
            'products' => json_encode($request->input('products')),
        ]);
        $validated = $request->validated();

        $order = Order::create($validated);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => new OrderResource($order),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        
        $order = Order::with(['user'])->where('user_id', auth()->id())->findOrFail($order->id);
        return new OrderResource($order);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
