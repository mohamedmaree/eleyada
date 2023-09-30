<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\discussions\Store;
use App\Http\Requests\Admin\discussions\Update;
use App\Models\Discussion ;
use App\Traits\Report;


class DiscussionController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $discussions = Discussion::search(request()->searchArray)->paginate(30);
            $html = view('admin.discussions.table' ,compact('discussions'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.discussions.index');
    }

    public function create()
    {
        return view('admin.discussions.create');
    }


    public function store(Store $request)
    {
        Discussion::create($request->validated());
        Report::addToLog('  اضافه مناقشة') ;
        return response()->json(['url' => route('admin.discussions.index')]);
    }
    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);
        return view('admin.discussions.edit' , ['discussion' => $discussion]);
    }

    public function update(Update $request, $id)
    {
        $discussion = Discussion::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل مناقشة') ;
        return response()->json(['url' => route('admin.discussions.index')]);
    }

    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        return view('admin.discussions.show' , ['discussion' => $discussion]);
    }
    public function destroy($id)
    {
        $discussion = Discussion::findOrFail($id)->delete();
        Report::addToLog('  حذف مناقشة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Discussion::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من المناقشات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
