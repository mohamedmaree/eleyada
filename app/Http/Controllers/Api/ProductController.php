<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Resources\Api\Products\ProductsCollection;
use App\Http\Resources\Api\Products\ProductsResource;

class ProductController extends Controller
{
  use ResponseTrait;
    public function index(){
        $products = Product::latest()->paginate($this->paginateNum());
        return $this->successData(new ProductsCollection($products));
    }

    public function show(Product $product)
    {
        return $this->successData(new ProductsResource($product));
    }
}
