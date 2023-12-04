<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\options\Store;
use App\Http\Requests\Admin\options\Update;
use App\Models\Options ;
use App\Traits\Report;

class OptionsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $options = Options::search(request()->searchArray)->paginate(30);
            $html = view('admin.options.table' ,compact('options'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.options.index');
    }

    public function create()
    {
        return view('admin.options.create');
    }


    public function store(Store $request)
    {
        Options::create($request->validated());
        Report::addToLog('  اضافه سمات المنتج') ;
        return response()->json(['url' => route('admin.options.index')]);
    }
    public function edit($id)
    {
        $option = Options::findOrFail($id);
        return view('admin.options.edit' , ['option' => $option]);
    }

    public function update(Update $request, $id)
    {
        $option = Options::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل سمات المنتج ') ;
        return response()->json(['url' => route('admin.options.index')]);
    }

    public function show($id)
    {
        $option = Options::findOrFail($id);
        return view('admin.options.show' , ['option' => $option]);
    }
    public function destroy($id)
    {
        $option = Options::findOrFail($id)->delete();
        Report::addToLog('  حذف  سمات المنتج') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Options::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من  سمات المنتج') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
