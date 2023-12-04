@extends('admin.layout.master')
@section('css')
<style>
        .uploadedBlock{
            margin: 5px !important;
        }
        .clickAdd{
            display: inline-block;
            width: 140px;
            height: 140px;
            line-height: 110px;
            text-align: center;
            position: relative;
            border-radius: 15px;
            margin: 5px;
            border: 3px dotted #e4e4e4;
            width: 140px;
            height: 140px;
            margin: 20px;
            border-radius: 28px;
        }        
        .delete-image{
            position: absolute;
            z-index: 9999999;
            left: 36%;
            top: 42%;
            background: bottom;
            font-size: 26px;
            border: aquamarine;
        }
</style>
@endsection
@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.view') . ' ' . __('admin.product')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  class="show form-horizontal" >
                            <div class="form-body">
                            <div class="row">
                                
                                {{-- to create languages tabs uncomment that --}}
                                <div class="col-12">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs  mb-3">
                                                @foreach (languages() as $lang)
                                                    <li class="nav-item">
                                                        <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                    </li>
                                                @endforeach
                                        </ul>
                                    </div> 

                                    <div class="col-12">
                                        <div class="imgMontg col-12 text-center">
                                            <div class="">
                                                <div class="textCenter">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="image" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{$product->icon}}">
                                                            {{-- <button class="close"><i class="feather icon-x"></i></button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="mt-3 mb-2 col-12 w-100 text-center ">{{__('admin.productpicture')}}</span>
                                    <div class="imgMontg col-12 text-center">
                                        <div class="dropBox d-flex">
                                            @foreach ($product->pictures as $image)
                                                <div class="textCenter">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="images[]" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{$image->image}}" class="im">
                                                            {{-- <button class="delete-image" data-id="{{$image->id}}" ><i class="feather icon-trash text-danger"></i></button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="tab-content">
                                            @foreach (languages() as $lang)
                                                <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                            <div class="controls">
                                                                <input type="text" value="{{$product->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-name">{{__('admin.details')}} {{ $lang }}</label>
                                                                <textarea class="form-control" name="details[{{$lang}}]" id="" cols="30" rows="10"  placeholder="{{__('admin.write') . __('admin.details')}} {{ $lang }} ">{{$product->getTranslations('details')[$lang]??''}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-name">{{__('admin.benefits')}} {{ $lang }}</label>
                                                                <textarea class="form-control"  name="benefits[{{$lang}}]" id="" cols="30" rows="10"  placeholder="{{__('admin.write') . __('admin.benefits')}} {{ $lang }} ">{{$product->getTranslations('benefits')[$lang]??''}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.price') }}</label>
                                                <div class="controls">
                                                    <input type="number" name="price" value="{{$product->price}}" class="form-control" min="0" step="0.01"
                                                        placeholder="{{ __('admin.price') }}" required
                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.video') }}</label>
                                                <div class="controls">
                                                    <input type="url" name="video" value="{{$product->video}}" class="form-control"
                                                        placeholder="{{ __('admin.video') }}" >
                                                </div>
                                            </div>
                                        </div>
                                       

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.producttype')}}</label>
                                            <div class="controls">
                                                <select name="product_type_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                    <option value>{{__('admin.producttype')}}</option>
                                                    @foreach ($productTypes as $productType)
                                                        <option {{$productType->id == $product->product_type_id ? 'selected' : ''}} value="{{$productType->id}}">{{$productType->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                {{--  to create languages tabs uncomment that --}}
                                </div>
                                <span class="mt-3 mb-2 col-12 w-100 text-center product_options">{{__('admin.options')}}</span>
                                    <div class="col-12 append_here product_options">
                                        @foreach($product->productOptions as $productOption)
                                            <div class="col-12 row">
                                                <div class="col-md-10 col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.option')}}</label>
                                                        <div class="controls">
                                                            <select name="options[]"  class="option_id select2 form-control" >
                                                                <option value>{{__('admin.option')}}</option>
                                                                @foreach ($options as $option)
                                                                    <option value="{{$option->id}}" {{$option->id == $productOption->option_id ? 'selected' : ''}}>{{$option->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="trash">
                                                    <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                                                </div> --}}
                                                    <div class="row col-12 append_values product_options_values">
                                                        @foreach($productOption->productOptionValues as $optionValue)
                                                            @foreach (languages() as $lang)
                                                                <div class="col-md-5 col-12" >
                                                                    <div class="form-group">
                                                                        <label for="first-name-column">{{__('admin.option_value')}} {{ $lang }}</label>
                                                                        <div class="controls">
                                                                            <input type="text"  name="option_values[{{ $lang }}][]" value="{{$optionValue->getTranslations('description')[$lang]??''}}" class="form-control" placeholder="{{__('admin.write').__('admin.option_value')}} {{ $lang }}"   >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            {{-- <div class="trash">
                                                                <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                                                            </div> --}}
                                                        @endforeach
                                                    </div>
                                                {{-- <div class="col-3">
                                                    <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_option_value product_options_values">+</button>
                                                </div> --}}
                                            </div>
                                    @endforeach
                                            
                                        </div>
                                        {{-- <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_option product_options">{{__('admin.add_option')}}</button> --}}
                                    
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
    <script>
        $('.show input').attr('disabled' , true)
        $('.show textarea').attr('disabled' , true)
        $('.show select').attr('disabled' , true)
    </script>
@endsection