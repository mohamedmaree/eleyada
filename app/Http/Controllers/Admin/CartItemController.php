<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cartitems\Store;
use App\Http\Requests\Admin\cartitems\Update;
use App\Models\CartItem ;
use App\Traits\Report;


class CartItemController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $cartitems = CartItem::search(request()->searchArray)->paginate(30);
            $html = view('admin.cartitems.table' ,compact('cartitems'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.cartitems.index');
    }

    public function create()
    {
        return view('admin.cartitems.create');
    }


    public function store(Store $request)
    {
        CartItem::create($request->validated());
        Report::addToLog('  اضافه سلة المشتريات') ;
        return response()->json(['url' => route('admin.cartitems.index')]);
    }
    public function edit($id)
    {
        $cartitem = CartItem::findOrFail($id);
        return view('admin.cartitems.edit' , ['cartitem' => $cartitem]);
    }

    public function update(Update $request, $id)
    {
        $cartitem = CartItem::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل سلة المشتريات') ;
        return response()->json(['url' => route('admin.cartitems.index')]);
    }

    public function show($id)
    {
        $cartitem = CartItem::findOrFail($id);
        return view('admin.cartitems.show' , ['cartitem' => $cartitem]);
    }
    public function destroy($id)
    {
        $cartitem = CartItem::findOrFail($id)->delete();
        Report::addToLog('  حذف سلة المشتريات') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CartItem::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من سلة المشتريات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
