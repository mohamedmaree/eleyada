@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
{{-- extra css files --}}

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.update') . ' ' . __('admin.order')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.orders.update' , ['id' => $order->id])}}" class="store form-horizontal" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    
                                    {{-- to create languages tabs uncomment that --}}
                                    {{-- <div class="col-12">
                                        <div class="col-12">
                                            <ul class="nav nav-tabs  mb-3">
                                                    @foreach (languages() as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                        </li>
                                                    @endforeach
                                            </ul>
                                        </div>  --}}

                                        
                                        {{-- <div class="tab-content">
                                                @foreach (languages() as $lang)
                                                    <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text" value="{{$order->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div> --}}
                                        
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.doctor')}}</label>
                                                    <div class="controls">
                                                        <select name="doctor_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                            <option value>{{__('admin.doctor')}}</option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{$doctor->id}}" {{ $order->doctor_id == $doctor->id ? 'selected' : '' }}>{{$doctor->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.region')}}</label>
                                                    <div class="controls">
                                                        <select name="region_id" class="select2 form-control" >
                                                            <option value>{{__('admin.region')}}</option>
                                                            @foreach ($regions as $region)
                                                                <option value="{{$region->id}}" {{ $order->region_id == $region->id ? 'selected' : '' }}>{{$region->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.name') }}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" value="{{ $order->name }}" class="form-control"
                                                            placeholder="{{ __('admin.name') }}" required
                                                            data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.phone') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="phone_number" value="{{ $order->phone_number }}" class="form-control"
                                                            placeholder="{{ __('admin.phone') }}" required
                                                            data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.address') }}</label>
                                                    <div class="controls">
                                                        <input type="text" name="address" value="{{ $order->address }}" class="form-control"
                                                            placeholder="{{ __('admin.address') }}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.delivery') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="delivery" value="{{ $order->delivery }}" min="0" step="0.01" class="form-control" required
                                                            data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.total_amount') }}</label>
                                                    <div class="controls">
                                                        <input type="number" name="total_amount" value="{{ $order->total_amount }}" min="0" step="0.01" class="form-control" required
                                                            data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.delivery_confirmation') }}</label>
                                                    <div class="controls">
                                                        <input type="datetime-local" name="delivery_confirmation" value="{{ $order->delivery_confirmation }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.status') }}</label>
                                                    <div class="controls">
                                                        <select name="status" class="select2 form-control" required
                                                            data-validation-required-message="{{ __('admin.status') }}">
                                                            <option value>{{ __('admin.status') }}</option>
                                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>{{ __('admin.delivered') }}</option>
                                                            <option value="in_progress" {{ $order->status == 'in_progress' ? 'selected' : '' }}>{{ __('admin.in_progress') }}</option>
                                                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>{{ __('admin.canceled') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                    {{--  to create languages tabs uncomment that --}}
                                    {{-- </div> --}}
                                    <span class="mt-3 mb-2 col-12 w-100 text-center user_names">{{__('admin.order_items')}}</span>
                                    <div class="col-12 append_here user_names">
                                            @foreach($order->orderItems as $item)
                                            <div class="col-12 row">
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.product')}}</label>
                                                        <div class="controls">
                                                            <select name="product_id[]" class="select2 form-control" >
                                                                <option value>{{__('admin.product')}}</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{$product->id}}" {{ $item->product_id == $product->id ? 'selected' :'' }}>{{$product->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.quantity')}}</label>
                                                        <div class="controls">
                                                            <input type="text"  name="quantity[]" value="{{ $item->quantity }}" class="form-control" placeholder="{{__('admin.quantity')}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.price')}}</label>
                                                        <div class="controls">
                                                            <input type="text"  name="price[]" value="{{ $item->price }}" class="form-control" placeholder="{{__('admin.price')}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.subtotal')}}</label>
                                                        <div class="controls">
                                                            <input type="text"  name="subtotal[]" value="{{ $item->subtotal }}" class="form-control" placeholder="{{__('admin.subtotal')}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="trash ">
                                                    <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                                                </div>

                                            
                                        </div>
                                        @endforeach
                                    </div>
                                    <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_name user_names">{{__('admin.add_item')}}</button>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
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
<div class="d-none">
    <div class="col-12 row delete_here" id="clone_div">
        <div class="col-md-5 col-12">
            <div class="form-group">
                <label for="first-name-column">{{__('admin.product')}}</label>
                <div class="controls">
                    <select name="product_id[]" class="form-control" >
                        <option value>{{__('admin.product')}}</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-6">
            <div class="form-group">
                <label for="first-name-column">{{__('admin.quantity')}}</label>
                <div class="controls">
                    <input type="text"  name="quantity[]" class="form-control" placeholder="{{__('admin.quantity')}}"  >
                </div>
            </div>
        </div>
        <div class="col-md-5 col-6">
            <div class="form-group">
                <label for="first-name-column">{{__('admin.price')}}</label>
                <div class="controls">
                    <input type="text"  name="price[]" class="form-control" placeholder="{{__('admin.price')}}"  >
                </div>
            </div>
        </div>
        <div class="col-md-5 col-6">
            <div class="form-group">
                <label for="first-name-column">{{__('admin.subtotal')}}</label>
                <div class="controls">
                    <input type="text"  name="subtotal[]" class="form-control" placeholder="{{__('admin.subtotal')}}"  >
                </div>
            </div>
        </div>
        
        <div class="trash ">
            <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    
    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit edit form script --}}
        @include('admin.shared.submitEditForm')
    {{-- submit edit form script --}}
    <script>
        $(document).on('click' , '.add_name', function (e) {
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
    </script>
@endsection