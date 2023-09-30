<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\productcustomfields\Store;
use App\Http\Requests\Admin\productcustomfields\Update;
use App\Models\ProductCustomField ;
use App\Traits\Report;


class ProductCustomFieldController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $productcustomfields = ProductCustomField::search(request()->searchArray)->paginate(30);
            $html = view('admin.productcustomfields.table' ,compact('productcustomfields'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.productcustomfields.index');
    }

    public function create()
    {
        return view('admin.productcustomfields.create');
    }


    public function store(Store $request)
    {
        ProductCustomField::create($request->validated());
        Report::addToLog('  اضافه الحقول الاضافية') ;
        return response()->json(['url' => route('admin.productcustomfields.index')]);
    }
    public function edit($id)
    {
        $productcustomfield = ProductCustomField::findOrFail($id);
        return view('admin.productcustomfields.edit' , ['productcustomfield' => $productcustomfield]);
    }

    public function update(Update $request, $id)
    {
        $productcustomfield = ProductCustomField::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل الحقول الاضافية') ;
        return response()->json(['url' => route('admin.productcustomfields.index')]);
    }

    public function show($id)
    {
        $productcustomfield = ProductCustomField::findOrFail($id);
        return view('admin.productcustomfields.show' , ['productcustomfield' => $productcustomfield]);
    }
    public function destroy($id)
    {
        $productcustomfield = ProductCustomField::findOrFail($id)->delete();
        Report::addToLog('  حذف الحقول الاضافية') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ProductCustomField::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الحقول الاضافية') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
