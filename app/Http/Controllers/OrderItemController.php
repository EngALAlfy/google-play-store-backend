<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemStoreRequest;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderItemController extends Controller
{
    public function store(OrderItemStoreRequest $request): Response
    {
        $orderItem = OrderItem::create($request->validated());
    }

    public function destroy(Request $request, OrderItem $orderItem): Response
    {
        $orderItem = OrderItem::find($id);

        $orderItem->delete();
    }
}
