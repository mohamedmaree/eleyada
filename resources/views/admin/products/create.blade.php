@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
<style>
    .clickAdd {
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
</style>
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.add') . ' ' . __('admin.product')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.products.store')}}" class="store form-horizontal" novalidate>
                            @csrf
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
                                                                <span>{{ __('admin.icon') }}</span>
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="icon" class="imageUploader">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="mt-3 mb-2 col-12 w-100 text-center ">{{__('admin.productpicture')}}</span>
                                        <div class="col-12">
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox d-flex">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="images[]"
                                                                    class="imageUploader">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="clickAdd">
                                                    <span>
                                                        <i class="feather icon-plus"></i>
                                                    </span>
                                                </button>
    
                                            </div>
                                        </div>

                                    {{-- to create languages tabs uncomment that --}}
                                       <div class="tab-content">
                                                @foreach (languages() as $lang)
                                                    <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">{{__('admin.details')}} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="details[{{$lang}}]" id="" cols="30" rows="10"  placeholder="{{__('admin.write') . __('admin.details')}} {{ $lang }} "></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">{{__('admin.benefits')}} {{ $lang }}</label>
                                                                    <textarea class="form-control" name="benefits[{{$lang}}]" id="" cols="30" rows="10"  placeholder="{{__('admin.write') . __('admin.benefits')}} {{ $lang }} "></textarea>
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
                                                        <input type="number" name="price" class="form-control" min="0" step="0.01"
                                                            placeholder="{{ __('admin.price') }}" required
                                                            data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.video') }}</label>
                                                    <div class="controls">
                                                        <input type="url" name="video" class="form-control"
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
                                                                <option value="{{$productType->id}}">{{$productType->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                    {{--  to create languages tabs uncomment that --}}
                                    </div>

                                    <span class="mt-3 mb-2 col-12 w-100 text-center product_options">{{__('admin.options')}}</span>
                                    <div class="col-12 append_here product_options">
                                        <div class="col-12 row">
                                            <div class="col-md-10 col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.option')}}</label>
                                                    <div class="controls">
                                                        <select name="options[]"  class="option_id select2 form-control" >
                                                            <option value>{{__('admin.option')}}</option>
                                                            @foreach ($options as $option)
                                                                <option value="{{$option->id}}">{{$option->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="trash">
                                                <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                                            </div>

                                            <div class="row col-12 append_values product_options_values">
                                                    @foreach (languages() as $lang)
                                                        <div class="col-md-5 col-12" >
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.option_value')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text"  name="option_values[{{ $lang }}][]" class="form-control" placeholder="{{__('admin.write').__('admin.option_value')}} {{ $lang }}"   >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="trash">
                                                        <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                                                    </div>
                                            </div>
                                            <div class="col-3">
                                                <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_option_value product_options_values">+</button>
                                            </div>
                                        </div>
                                           
                                    </div>
                                    <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_option product_options">{{__('admin.add_option')}}</button>
                                

                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 submit_button">{{ __('admin.add') }}</button>
                                            <a href="{{ url()->previous() }}" type="reset"
                                                class="btn btn-outline-warning mr-1 mb-1">{{ __('admin.back') }}</a>
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

    <div class="d-none">
        <div class="col-12 row delete_here" id="clone_div">
            <div class="col-md-10 col-6">
                <div class="form-group">
                    <label for="first-name-column">{{__('admin.option')}}</label>
                    <div class="controls">
                        <select name="options[]"  class="option_id form-control">
                            <option value>{{__('admin.option')}}</option>
                            @foreach ($options as $option)
                                <option value="{{$option->id}}">{{$option->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="trash">
                <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
            </div>

            <div class="row col-12 append_values product_options_values">
                    @foreach (languages() as $lang)
                        <div class="col-md-5 col-12" >
                            <div class="form-group">
                                <label for="first-name-column">{{__('admin.option_value')}} {{ $lang }}</label>
                                <div class="controls">
                                    <input type="text"  name="option_values[{{ $lang }}][]" class="form-control" placeholder="{{__('admin.write').__('admin.option_value')}} {{ $lang }}"   >
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="trash">
                        <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                    </div>
            </div>
            <div class="col-3">
                <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_option_value product_options_values">+</button>
            </div>
        </div>
    </div>

    <div class="d-none">
        <div class="row col-12 " id="clone_div2">
        @foreach (languages() as $lang)
            <div class="col-md-5 col-12" >
                <div class="form-group">
                    <label for="first-name-column">{{__('admin.option_value')}} {{ $lang }}</label>
                    <div class="controls">
                        <input type="text"  name="option_values[{{ $lang }}][]" class="form-control" placeholder="{{__('admin.write').__('admin.option_value')}} {{ $lang }}"   >
                    </div>
                </div>
            </div>
        @endforeach
        <div class="trash">
            <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>

    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
    @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}
    <script>
        $(document).on('click' , '.add_option', function (e) {
            e.preventDefault();
            var copy = $('#clone_div').clone()
            copy.find('.d-none').removeClass('d-none')
            copy.find('#clone_div').removeAttr('id')
            copy.find('.form-control').val(null)
            $('.append_here').append(copy)
        });
        $(document).on('click' , '.removeeventmore', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove()
        }); 
        
        $(document).on('click' , '.add_option_value', function (e) {
            e.preventDefault();
            var copy = $('#clone_div2').clone()
            copy.find('.d-none').removeClass('d-none')
            copy.find('#clone_div2').removeAttr('id')
            copy.find('.form-control').val(null)
            $('.append_values').append(copy)
        });
    </script>
@endsection
