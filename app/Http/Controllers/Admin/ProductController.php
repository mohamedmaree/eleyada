<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\products\Store;
use App\Http\Requests\Admin\products\Update;
use App\Models\Product ;
use App\Traits\Report;


class ProductController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $products = Product::search(request()->searchArray)->paginate(30);
            $html = view('admin.products.table' ,compact('products'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }


    public function store(Store $request)
    {
        Product::create($request->validated());
        Report::addToLog('  اضافه المنتج') ;
        return response()->json(['url' => route('admin.products.index')]);
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit' , ['product' => $product]);
    }

    public function update(Update $request, $id)
    {
        $product = Product::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل المنتج') ;
        return response()->json(['url' => route('admin.products.index')]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show' , ['product' => $product]);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        Report::addToLog('  حذف المنتج') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Product::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من المنتجات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
