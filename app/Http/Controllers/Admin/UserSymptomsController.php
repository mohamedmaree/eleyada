<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\usersymptoms\Store;
use App\Http\Requests\Admin\usersymptoms\Update;
use App\Models\UserSymptoms ;
use App\Traits\Report;


class UserSymptomsController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $usersymptoms = UserSymptoms::search(request()->searchArray)->paginate(30);
            $html = view('admin.usersymptoms.table' ,compact('usersymptoms'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.usersymptoms.index');
    }

    public function create()
    {
        return view('admin.usersymptoms.create');
    }


    public function store(Store $request)
    {
        UserSymptoms::create($request->validated());
        Report::addToLog('  اضافه الأعراض') ;
        return response()->json(['url' => route('admin.usersymptoms.index')]);
    }
    public function edit($id)
    {
        $usersymptoms = UserSymptoms::findOrFail($id);
        return view('admin.usersymptoms.edit' , ['usersymptoms' => $usersymptoms]);
    }

    public function update(Update $request, $id)
    {
        $usersymptoms = UserSymptoms::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل الأعراض') ;
        return response()->json(['url' => route('admin.usersymptoms.index')]);
    }

    public function show($id)
    {
        $usersymptoms = UserSymptoms::findOrFail($id);
        return view('admin.usersymptoms.show' , ['usersymptoms' => $usersymptoms]);
    }
    public function destroy($id)
    {
        $usersymptoms = UserSymptoms::findOrFail($id)->delete();
        Report::addToLog('  حذف الأعراض') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (UserSymptoms::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الأعراض') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
