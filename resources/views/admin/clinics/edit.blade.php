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
                    <h4 class="card-title">{{__('admin.update') . ' ' . __('admin.clinic')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.clinics.update' , ['id' => $clinic->id])}}" class="store form-horizontal" novalidate>
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

                                        <div class="col-12">
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="image" class="imageUploader">
                                                            </label>
                                                            <div class="uploadedBlock">
                                                                <img src="{{$clinic->image}}">
                                                                <button class="close"><i class="feather icon-x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="tab-content">
                                                @foreach (languages() as $lang)
                                                    <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                <div class="controls">
                                                                    <input type="text" value="{{$clinic->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div> --}}
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.name')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="name" value="{{$clinic->name}}" class="form-control" placeholder="{{__('admin.name')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.phone')}}</label>
                                                <div class="controls">
                                                    <input type="number" name="phone" value="{{$clinic->phone}}" class="form-control" placeholder="{{__('admin.phone')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.email')}}</label>
                                                <div class="controls">
                                                    <input type="email" name="email" value="{{$clinic->email}}" class="form-control" placeholder="{{__('admin.email')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.password')}}</label>
                                                <div class="controls">
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{__('admin.description')}}</label>
                                                    <textarea class="form-control" name="title" id="" cols="30" rows="10" placeholder="{{__('admin.about_the_application_in_english')}}">{{$clinic->title}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.Validity')}}</label>
                                                <div class="controls">
                                                    <select name="role_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.Select_the_validity')}}</option>
                                                        @foreach ($roles as $role)
                                                            <option {{$role->id == $clinic->role_id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}

                                    {{--  to create languages tabs uncomment that --}}
                                    {{-- </div> --}}
                                    
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
    
@endsection