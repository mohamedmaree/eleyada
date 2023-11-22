@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.view') . ' ' . __('admin.livevideo')}}</h4>
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
                                                <div class="dropBox">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input type="file" accept="image/*" name="image" class="imageUploader">
                                                            </label>
                                                            <div class="uploadedBlock">
                                                                <img src="{{$livevideo->image}}">
                                                                <button class="close"><i class="feather icon-x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            @foreach (languages() as $lang)
                                                <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">{{__('admin.title')}} {{ $lang }}</label>
                                                            <div class="controls">
                                                                <input type="text" value="{{$livevideo->getTranslations('title')[$lang]??''}}" name="title[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.title')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-name">{{__('admin.topics')}} {{ $lang }}</label>
                                                                <textarea class="form-control" name="topics[{{$lang}}]" id="" cols="30" rows="10"  placeholder="{{__('admin.write') . __('admin.topics')}} {{ $lang }} ">{{$livevideo->getTranslations('topics')[$lang]??''}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.discussion_link') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="link" value="{{ $livevideo->link }}" class="form-control" placeholder="{{ __('admin.discussion_link') }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.speaker_name') }}</label>
                                                <div class="controls">
                                                    <input type="text" name="speaker_name"  value="{{ $livevideo->speaker_name }}" class="form-control" placeholder="{{ __('admin.speaker_name') }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                </div>
                                            </div>
                                        </div>
                                       

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{ __('admin.status') }}</label>
                                                <div class="controls">
                                                    <select name="status" class="select2 form-control" required data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                        <option value>{{ __('admin.status') }}</option>
                                                        <option value="live" {{$livevideo->status == 'live' ? 'selected' : ''}}>{{ __('admin.live') }}</option>
                                                        <option value="past" {{$livevideo->status == 'past' ? 'selected' : ''}}>{{ __('admin.past') }}</option>
                                                        <option value="upcoming" {{$livevideo->status == 'upcoming' ? 'selected' : ''}}>{{ __('admin.upcoming') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    {{--  to create languages tabs uncomment that --}}
                                    </div>
                                    
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