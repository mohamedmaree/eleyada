<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\productoptions\Store;
use App\Http\Requests\Admin\productoptions\Update;
use App\Models\ProductOptions ;
use App\Traits\Report;


class ProductOptionsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $productoptions = ProductOptions::search(request()->searchArray)->paginate(30);
            $html = view('admin.productoptions.table' ,compact('productoptions'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.productoptions.index');
    }

    public function create()
    {
        return view('admin.productoptions.create');
    }


    public function store(Store $request)
    {
        ProductOptions::create($request->validated());
        Report::addToLog('  اضافه خيارات المنتجات') ;
        return response()->json(['url' => route('admin.productoptions.index')]);
    }
    public function edit($id)
    {
        $productoptions = ProductOptions::findOrFail($id);
        return view('admin.productoptions.edit' , ['productoptions' => $productoptions]);
    }

    public function update(Update $request, $id)
    {
        $productoptions = ProductOptions::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل خيارات المنتجات') ;
        return response()->json(['url' => route('admin.productoptions.index')]);
    }

    public function show($id)
    {
        $productoptions = ProductOptions::findOrFail($id);
        return view('admin.productoptions.show' , ['productoptions' => $productoptions]);
    }
    public function destroy($id)
    {
        $productoptions = ProductOptions::findOrFail($id)->delete();
        Report::addToLog('  حذف خيارات المنتجات') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ProductOptions::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من خيارات المنتجات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
