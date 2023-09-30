<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\producttypes\Store;
use App\Http\Requests\Admin\producttypes\Update;
use App\Models\ProductType ;
use App\Traits\Report;


class ProductTypeController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $producttypes = ProductType::search(request()->searchArray)->paginate(30);
            $html = view('admin.producttypes.table' ,compact('producttypes'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.producttypes.index');
    }

    public function create()
    {
        return view('admin.producttypes.create');
    }


    public function store(Store $request)
    {
        ProductType::create($request->validated());
        Report::addToLog('  اضافه أنواع المنتجات') ;
        return response()->json(['url' => route('admin.producttypes.index')]);
    }
    public function edit($id)
    {
        $producttype = ProductType::findOrFail($id);
        return view('admin.producttypes.edit' , ['producttype' => $producttype]);
    }

    public function update(Update $request, $id)
    {
        $producttype = ProductType::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل أنواع المنتجات') ;
        return response()->json(['url' => route('admin.producttypes.index')]);
    }

    public function show($id)
    {
        $producttype = ProductType::findOrFail($id);
        return view('admin.producttypes.show' , ['producttype' => $producttype]);
    }
    public function destroy($id)
    {
        $producttype = ProductType::findOrFail($id)->delete();
        Report::addToLog('  حذف أنواع المنتجات') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ProductType::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من أنواع المنتجات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
