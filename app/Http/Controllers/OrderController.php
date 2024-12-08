<?php

namespace App\Http\Controllers;

use App\Events\NewOrderPlaced;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Jobs\ProcessOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(Request $request): Response
    {
        $orders = Order::all();
    }

    public function store(OrderStoreRequest $request): Response
    {
        $order = Order::create($request->validated());

        ProcessOrder::dispatch($order);

        NewOrderPlaced::dispatch($order);
    }

    public function show(Request $request, Order $order): Response
    {
        $order = Order::find($id);
    }

    public function update(OrderUpdateRequest $request, Order $order): Response
    {
        $order = Order::find($id);


        $order->update($request->validated());
    }

    public function destroy(Request $request, Order $order): Response
    {
        $order = Order::find($id);

        $order->delete();
    }
}
