<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\orders\Store;
use App\Http\Requests\Admin\orders\Update;
use App\Models\Order ;
use App\Traits\Report;
use App\Models\Doctor ;
use App\Models\Region ;
use App\Models\Product ;

class OrderController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $orders = Order::search(request()->searchArray)->paginate(30);
            $html = view('admin.orders.table' ,compact('orders'))->render() ;
            return response()->json(['html' => $html]);
        }
        $doctors = Doctor::orderBy('name','ASC')->get();
        $regions = Region::orderBy('name','ASC')->get();
        return view('admin.orders.index',get_defined_vars());
    }

    public function create()
    {
        $doctors = Doctor::orderBy('name','ASC')->get();
        $regions = Region::orderBy('name','ASC')->get();
        $products = Product::orderBy('name','ASC')->get();
        return view('admin.orders.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        $order = Order::create($request->validated());
        if ($request->product_id) {
            $items = [];
            $i=0;
            foreach ($request->product_id as $value) {
                $items[] = ['product_id' => $value ,'quantity' => $request->quantity[$i]??0,'price' => $request->price[$i]??0,'subtotal' => $request->subtotal[$i]??0];
                $i++;
            }
            $order->orderItems()->createMany($items);
        }
        Report::addToLog('  اضافه الطلب') ;
        return response()->json(['url' => route('admin.orders.index')]);
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $doctors = Doctor::orderBy('name','ASC')->get();
        $regions = Region::orderBy('name','ASC')->get();
        $products = Product::orderBy('name','ASC')->get();
        return view('admin.orders.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());
        if ($request->product_id) {
            $order->orderItems()->delete();
            $items = [];
            $i=0;
            foreach ($request->product_id as $value) {
                $items[] = ['product_id' => $value ,'quantity' => $request->quantity[$i]??0,'price' => $request->price[$i]??0,'subtotal' => $request->subtotal[$i]??0];
                $i++;
            }
            $order->orderItems()->createMany($items);
        }
        Report::addToLog('  تعديل الطلب') ;
        return response()->json(['url' => route('admin.orders.index')]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $doctors = Doctor::orderBy('name','ASC')->get();
        $regions = Region::orderBy('name','ASC')->get();
        $products = Product::orderBy('name','ASC')->get();
        return view('admin.orders.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id)->delete();
        Report::addToLog('  حذف الطلب') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Order::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الطلبات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
