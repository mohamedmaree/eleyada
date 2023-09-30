<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;

use App\Events\PlaceOrder;
use App\Http\Requests\Api\PlaceOrderRequest;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Api\Orders\OrdersCollection;
use App\Http\Resources\Api\Orders\OrdersResource;

class OrderController extends Controller
{
    use ResponseTrait;

public function index()
{
    $orders = Order::whereDoctorId(auth()->id())
        ->with([
            'orderItems',
            'orderItems.product.pictures'
        ])
        ->latest()
        ->paginate($this->paginateNum());
    return $this->successData(new OrdersCollection($orders));

}

public function show(Order $order)
{
    if (request()->has('mark_as')) {
        match (OrderStatus::load(request()->query('mark_as'))) {
            OrderStatus::CANCELED->name => $order->update(['status' => OrderStatus::CANCELED]),
            OrderStatus::DELIVERED->name => $order->update(['status' => OrderStatus::DELIVERED]),
            OrderStatus::CONFIRMED->name => $order->update(['status' => OrderStatus::DELIVERED, 'delivery_confirmation' => now()]),
            default => throw new \Exception('Unexpected status value'),
        };
        return $this->successMsg('Order was marked as ' . request()->query('mark_as') . ' successfully ');
    }
    return $this->successData(new OrdersResource($order
    ->load([
        'orderItems',
        'orderItems.product.pictures'
    ])));
}

    public function placeOrder(PlaceOrderRequest $request){
        try {
            DB::beginTransaction();
            $cartItems = CartItem::with('product')->get();
            $total = $cartItems->sum(fn(CartItem $item) => $item->quantity * $item->product->price);
            $order = Order::create([
                'name'           => $request['name'] ?? auth()->user()->name,
                'doctor_id'      => auth()->id(),
                'address'        => $request['address'],
                'phone_number'   => $request['phone_number'] ?? '0'.auth()->user()->phone,
                'total_amount'   => 40 + $total,
                'region_id'      => $request['governorate_id'],
            ]);

            $cartItems->each(fn(CartItem $item) => OrderItem::create([
                'price'      => $item->product->price??0,
                'product_id' => $item->product_id,
                'order_id'   => $order->id,
                'quantity'   => $item->quantity,
                'subtotal'   => $item->product->price * $item->quantity,
            ]));

            CartItem::whereDoctorId(auth()->id())->delete();

            event(new PlaceOrder($order,auth()->user()->email));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['result' => $e->getMessage()], 500);
        }
        return $this->successMsg(__('apis.added'));
    }

}
