<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\orderitems\Store;
use App\Http\Requests\Admin\orderitems\Update;
use App\Models\OrderItem ;
use App\Traits\Report;


class OrderItemController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $orderitems = OrderItem::search(request()->searchArray)->paginate(30);
            $html = view('admin.orderitems.table' ,compact('orderitems'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.orderitems.index');
    }

    public function create()
    {
        return view('admin.orderitems.create');
    }


    public function store(Store $request)
    {
        OrderItem::create($request->validated());
        Report::addToLog('  اضافه عناصر الطلب') ;
        return response()->json(['url' => route('admin.orderitems.index')]);
    }
    public function edit($id)
    {
        $orderitem = OrderItem::findOrFail($id);
        return view('admin.orderitems.edit' , ['orderitem' => $orderitem]);
    }

    public function update(Update $request, $id)
    {
        $orderitem = OrderItem::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل عناصر الطلب') ;
        return response()->json(['url' => route('admin.orderitems.index')]);
    }

    public function show($id)
    {
        $orderitem = OrderItem::findOrFail($id);
        return view('admin.orderitems.show' , ['orderitem' => $orderitem]);
    }
    public function destroy($id)
    {
        $orderitem = OrderItem::findOrFail($id)->delete();
        Report::addToLog('  حذف عناصر الطلب') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (OrderItem::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من عناصر الطلب') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
