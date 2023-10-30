<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\productoptionsvalues\Store;
use App\Http\Requests\Admin\productoptionsvalues\Update;
use App\Models\ProductOptionsValues ;
use App\Traits\Report;


class ProductOptionsValuesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $productoptionsvalues = ProductOptionsValues::search(request()->searchArray)->paginate(30);
            $html = view('admin.productoptionsvalues.table' ,compact('productoptionsvalues'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.productoptionsvalues.index');
    }

    public function create()
    {
        return view('admin.productoptionsvalues.create');
    }


    public function store(Store $request)
    {
        ProductOptionsValues::create($request->validated());
        Report::addToLog('  اضافه قيم خيارات المنتجات') ;
        return response()->json(['url' => route('admin.productoptionsvalues.index')]);
    }
    public function edit($id)
    {
        $productoptionsvalues = ProductOptionsValues::findOrFail($id);
        return view('admin.productoptionsvalues.edit' , ['productoptionsvalues' => $productoptionsvalues]);
    }

    public function update(Update $request, $id)
    {
        $productoptionsvalues = ProductOptionsValues::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل قيم خيارات المنتجات') ;
        return response()->json(['url' => route('admin.productoptionsvalues.index')]);
    }

    public function show($id)
    {
        $productoptionsvalues = ProductOptionsValues::findOrFail($id);
        return view('admin.productoptionsvalues.show' , ['productoptionsvalues' => $productoptionsvalues]);
    }
    public function destroy($id)
    {
        $productoptionsvalues = ProductOptionsValues::findOrFail($id)->delete();
        Report::addToLog('  حذف قيم خيارات المنتجات') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ProductOptionsValues::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من قيم خيارات المنتجات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
