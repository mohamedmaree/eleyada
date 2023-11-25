@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<form  method="POST" action="" class="store form-horizontal" novalidate>
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-md-3">
                <div class="col-12 card card-body">
                    <div class="imgMontg col-12 text-center">
                            <div class="dropBox">
                                <div class="textCenter">
                                    <div class="imagesUploadBlock">
                                        <label class="uploadImg">
                                            <span><i class="feather icon-image"></i></span>
                                            <input type="file" accept="image/*" name="image" class="imageUploader">
                                        </label>
                                        <div class="uploadedBlock">
                                            <img src="{{$row->image}}">
                                            <button class="close"><i class="la la-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="col-9">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">{{__('admin.edit')}}</h4>
                    </div> --}}
                    <div class="card-content">
                        <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 card card-body">
                                            <div class="imgMontg col-12 text-center">
                                                    <div class="dropBox">
                                                        <div class="textCenter">
                                                            <div class="imagesUploadBlock">
                                                                <label class="uploadImg">
                                                                    <span>{{ __('admin.identity_proof') }}</span>
                                                                    <span><i class="feather icon-image"></i></span>
                                                                    <input type="file" accept="image/*" name="identity_proof" class="imageUploader">
                                                                </label>
                                                                <div class="uploadedBlock">
                                                                    <img src="{{$row->identity_proof}}">
                                                                    <button class="close"><i class="la la-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.name')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="name" value="{{$row->name}}" class="form-control" placeholder="{{__('admin.write_the_name')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.phone_number')}}</label>
                                                <div class="row">
                                                    <div class="col-md-4 col-12">
                                                        <select name="country_code" class="form-control select2">
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->key }}"
                                                                    @if ($row->country_code == $country->key)
                                                                        selected
                                                                    @endif >
                                                                {{ '+'.$country->key }}{{ $country->flag}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-8 col-12">
                                                        <div class="controls">
                                                            <input type="number" name="phone" value="{{$row->phone}}"  class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.email')}}</label>
                                                <div class="controls">
                                                    <input type="email" name="email" value="{{$row->email}}" class="form-control" placeholder="{{__('admin.enter_the_email')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-email-message="{{__('admin.email_formula_is_incorrect')}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.password')}}</label>
                                                <div class="controls">
                                                    <input type="password" name="password" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.countries')}}</label>
                                                <div class="controls">
                                                    <select name="country_id" class="select2 form-control"  >
                                                        <option value>{{__('admin.country')}}</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{$country->id}}" {{$row->country_id == $country->id ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.speciality')}}</label>
                                                <div class="controls">
                                                    <select name="speciality_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                        <option value>{{__('admin.speciality')}}</option>
                                                        @foreach ($specialities as $speciality)
                                                            <option value="{{$speciality->id}}" {{$row->speciality_id == $speciality->id ? 'selected':''}}>{{$speciality->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.academicdegree')}}</label>
                                                <div class="controls">
                                                    <select name="academic_degree_id" class="select2 form-control"  >
                                                        <option value>{{__('admin.academicdegree')}}</option>
                                                        @foreach ($academic_degrees as $academic_degree)
                                                            <option value="{{$academic_degree->id}}" {{$row->academic_degree_id == $academic_degree->id ? 'selected':''}}>{{$academic_degree->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.phone_activation_status')}}</label>
                                                <div class="controls">
                                                    <select name="active" class="select2 form-control"  >
                                                        <option value>{{__('admin.phone_activation_status')}}</option>
                                                        <option value="1" {{$row->active == 1 ? 'selected':''}}>{{__('admin.activate')}}</option>
                                                        <option value="0" {{$row->active == 0 ? 'selected':''}}>{{__('admin.dis_activate')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('admin.Validity')}}</label>
                                                <div class="controls">
                                                    <select name="is_blocked" class="select2 form-control" >
                                                        <option value>{{__('admin.Select_the_blocking_status')}}</option>
                                                        <option {{$row->is_blocked == 1 ? 'selected' : ''}} value="1">{{__('admin.Prohibited')}}</option>
                                                        <option {{$row->is_blocked == 0 ? 'selected' : ''}} value="0">{{__('admin.Unspoken')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>

@endsection

@section('js')
    <script>
        $('.show input').attr('disabled' , true)
        $('.show textarea').attr('disabled' , true)
        $('.show select').attr('disabled' , true)
    </script>
@endsection