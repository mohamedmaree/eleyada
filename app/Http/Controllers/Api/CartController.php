<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Api\CartItemsResource;

class CartController extends Controller {
  use ResponseTrait;

    public function index()
    {
        $cartItems = CartItem::with([
                'product',
                'product.pictures'
            ])
            ->where('doctor_id', auth()->id())
            ->get();
        return $this->successData(CartItemsResource::collection($cartItems));
    }

    public function addToCart(Product $product){
        if ($product->cartItems()->where('doctor_id', auth()->id())->exists()) {
            $cartItem = $product->cartItems()->where('doctor_id', auth()->id())->first();
            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
            ]);
        return $this->successMsg(__('apis.added'));
        }

        $product->cartItems()->create([
            'quantity' => 1,
            'doctor_id' => auth()->id(),
        ]);
        return $this->successMsg(__('apis.added'));
    }

    public function removeFromCart(Product $product): JsonResponse{
        if ($product->cartItems()->where('doctor_id', auth()->id())->exists()) {
            $cartItem = $product->cartItems()->where('doctor_id', auth()->id())->first();
            if ($cartItem->quantity == 1) {
                $cartItem->delete();
                return $this->successMsg(__('apis.deleted'));
            }
            $cartItem->update([
                'quantity' => $cartItem->quantity - 1,
            ]);
        }
        return $this->successMsg(__('apis.deleted'));
    }

}
