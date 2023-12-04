<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\products\Store;
use App\Http\Requests\Admin\products\Update;
use App\Models\Product ;
use App\Models\ProductType ;
use App\Traits\Report;
use App\Models\ProductPicture ;
use App\Models\Options ;
use App\Models\ProductOptionsValues ;

class ProductController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $products = Product::search(request()->searchArray)->paginate(30);
            $html = view('admin.products.table' ,compact('products'))->render() ;
            return response()->json(['html' => $html]);
        }
        $productTypes = ProductType::orderBy('name','ASC')->get();
        return view('admin.products.index',get_defined_vars());
    }

    public function create()
    {
        $productTypes = ProductType::orderBy('name','ASC')->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.products.create',get_defined_vars());
    }

    private function storeFiles($product, $files)
    {    
        foreach ($files as $file) {
            $product->pictures()->create(['image' => $file]);
        }
    }

    public function store(Store $request)
    {
        $product = Product::create($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($product, $request->file('images'));
        }
        if($request->options){
            $product_options = [];
            $i = 0;
            foreach($request->options as $option){
                $product_option = $product->productOptions()->create(['option_id' => $option]);
                foreach($request->option_values as $option_value){
                    $new_option_value['ar'] = $request->option_values['ar'][$i]??'';
                    $new_option_value['en'] = $request->option_values['en'][$i]??'';
                    $product_option->productOptionValues()->create(['description' => $new_option_value]);
                    $i++;
                }
            }
        }

        Report::addToLog('  اضافه المنتج') ;
        return response()->json(['url' => route('admin.products.index')]);
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $productTypes = ProductType::orderBy('name','ASC')->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.products.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($product, $request->file('images'));
        }
        if($request->options){
            $options_ids = $product->productOptions()->pluck('id')->toArray()??[];
            ProductOptionsValues::whereIn('product_option_id',$options_ids)->delete();
            $product->productOptions()->delete();
            $product_options = [];
            $i = 0;
            foreach($request->options as $option){
                $product_option = $product->productOptions()->create(['option_id' => $option]);
                foreach($request->option_values as $option_value){
                    $new_option_value['ar'] = $request->option_values['ar'][$i]??'';
                    $new_option_value['en'] = $request->option_values['en'][$i]??'';
                    $product_option->productOptionValues()->create(['description' => $new_option_value]);
                    $i++;
                }
            }
        }

        Report::addToLog('  تعديل المنتج') ;
        return response()->json(['url' => route('admin.products.index')]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $productTypes = ProductType::orderBy('name','ASC')->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.products.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        Report::addToLog('  حذف المنتج') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Product::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من المنتجات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function deleteImage(Request $request)
    {
        $image = ProductPicture::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }
}
