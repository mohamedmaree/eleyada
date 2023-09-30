<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\productpictures\Store;
use App\Http\Requests\Admin\productpictures\Update;
use App\Models\ProductPicture ;
use App\Traits\Report;


class ProductPictureController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $productpictures = ProductPicture::search(request()->searchArray)->paginate(30);
            $html = view('admin.productpictures.table' ,compact('productpictures'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.productpictures.index');
    }

    public function create()
    {
        return view('admin.productpictures.create');
    }


    public function store(Store $request)
    {
        ProductPicture::create($request->validated());
        Report::addToLog('  اضافه صور المنتج') ;
        return response()->json(['url' => route('admin.productpictures.index')]);
    }
    public function edit($id)
    {
        $productpicture = ProductPicture::findOrFail($id);
        return view('admin.productpictures.edit' , ['productpicture' => $productpicture]);
    }

    public function update(Update $request, $id)
    {
        $productpicture = ProductPicture::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل صور المنتج') ;
        return response()->json(['url' => route('admin.productpictures.index')]);
    }

    public function show($id)
    {
        $productpicture = ProductPicture::findOrFail($id);
        return view('admin.productpictures.show' , ['productpicture' => $productpicture]);
    }
    public function destroy($id)
    {
        $productpicture = ProductPicture::findOrFail($id)->delete();
        Report::addToLog('  حذف صور المنتج') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ProductPicture::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من صورة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
