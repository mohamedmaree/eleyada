<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\certificates\Store;
use App\Http\Requests\Admin\certificates\Update;
use App\Models\Certificate ;
use App\Traits\Report;


class CertificateController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $certificates = Certificate::search(request()->searchArray)->paginate(30);
            $html = view('admin.certificates.table' ,compact('certificates'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.certificates.index');
    }

    public function create()
    {
        return view('admin.certificates.create');
    }


    public function store(Store $request)
    {
        Certificate::create($request->validated());
        Report::addToLog('  اضافه الشهادة') ;
        return response()->json(['url' => route('admin.certificates.index')]);
    }
    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.edit' , ['certificate' => $certificate]);
    }

    public function update(Update $request, $id)
    {
        $certificate = Certificate::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل الشهادة') ;
        return response()->json(['url' => route('admin.certificates.index')]);
    }

    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.show' , ['certificate' => $certificate]);
    }
    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id)->delete();
        Report::addToLog('  حذف الشهادة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Certificate::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الشهادات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
