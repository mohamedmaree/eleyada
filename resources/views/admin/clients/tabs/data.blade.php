<div class="tab-pane fade active show" id="data">
    <div class="row">
    <div class="col-6">
        <div class="imgMontg col-12 text-center">
            <div class="dropBox">
                <div class="textCenter">
                    <div class="imagesUploadBlock">
                        <label class="uploadImg">
                            <span>{{ __('admin.image') }}</span>
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
    
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.name')}}</label>
            <div class="controls">
                <input type="text" name="name" value="{{$row->name}}" class="form-control" placeholder="{{__('admin.write_the_name')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.phone_number')}}</label>
            <div class="controls">
                <input type="number" name="phone" value="{{'0'.$row->phone}}" class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required  data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.email')}}</label>
            <div class="controls">
                <input type="email" name="email" value="{{$row->email}}" class="form-control" placeholder="{{__('admin.enter_the_email')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-email-message="{{__('admin.email_formula_is_incorrect')}}" disabled>
            </div>
        </div>
    </div>


 
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.Validity')}}</label>
            <div class="controls">
                <input type="text" name="is_blocked" value="{{$row->is_blocked == 1 ? __('admin.Prohibited') : __('admin.Unspoken') }}" class="form-control" disabled >
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="first-name-column">{{__('admin.activation')}}</label>
            <div class="controls">
                <input type="text" name="active" value="{{$row->is_blocked == 1 ? __('admin.activate') : __('admin.dis_activate') }}" class="form-control" disabled >
            </div>
        </div>
    </div>

   
    <div class="col-12 d-flex justify-content-center mt-3">
        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
    </div>
</div>
</div>
