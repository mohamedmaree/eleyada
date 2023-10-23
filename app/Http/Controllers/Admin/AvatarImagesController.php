<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\avatarimages\Store;
use App\Http\Requests\Admin\avatarimages\Update;
use App\Models\AvatarImages ;
use App\Traits\Report;


class AvatarImagesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $avatarimages = AvatarImages::search(request()->searchArray)->paginate(30);
            $html = view('admin.avatarimages.table' ,compact('avatarimages'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.avatarimages.index');
    }

    public function create()
    {
        return view('admin.avatarimages.create');
    }


    public function store(Store $request)
    {
        AvatarImages::create($request->validated());
        Report::addToLog('  اضافه صور المستخدمين') ;
        return response()->json(['url' => route('admin.avatarimages.index')]);
    }
    public function edit($id)
    {
        $avatarimages = AvatarImages::findOrFail($id);
        return view('admin.avatarimages.edit' , ['avatarimages' => $avatarimages]);
    }

    public function update(Update $request, $id)
    {
        $avatarimages = AvatarImages::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل صور المستخدمين') ;
        return response()->json(['url' => route('admin.avatarimages.index')]);
    }

    public function show($id)
    {
        $avatarimages = AvatarImages::findOrFail($id);
        return view('admin.avatarimages.show' , ['avatarimages' => $avatarimages]);
    }
    public function destroy($id)
    {
        $avatarimages = AvatarImages::findOrFail($id)->delete();
        Report::addToLog('  حذف صور المستخدمين') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (AvatarImages::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من صور المستخدمين') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
