<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\trainings\Store;
use App\Http\Requests\Admin\trainings\Update;
use App\Models\Training ;
use App\Models\Product ;
use App\Traits\Report;


class TrainingController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $trainings = Training::search(request()->searchArray)->paginate(30);
            $html = view('admin.trainings.table' ,compact('trainings'))->render() ;
            return response()->json(['html' => $html]);
        }
        $products = Product::latest()->get();
        return view('admin.trainings.index',get_defined_vars());
    }

    public function create()
    {
        $products = Product::latest()->get();
        return view('admin.trainings.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        Training::create($request->validated());
        Report::addToLog('  اضافه التدريب') ;
        return response()->json(['url' => route('admin.trainings.index')]);
    }
    public function edit($id)
    {
        $training = Training::findOrFail($id);
        $products = Product::latest()->get();
        return view('admin.trainings.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $training = Training::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل التدريب') ;
        return response()->json(['url' => route('admin.trainings.index')]);
    }

    public function show($id)
    {
        $training = Training::findOrFail($id);
        $products = Product::latest()->get();
        return view('admin.trainings.show',get_defined_vars());
    }
    public function destroy($id)
    {
        $training = Training::findOrFail($id)->delete();
        Report::addToLog('  حذف التدريب') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Training::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من التدريبات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
