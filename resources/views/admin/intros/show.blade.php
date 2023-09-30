@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{__('admin.view')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  class="store form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    
                                    <div class="col-12">
                                        <div class="col-12">
                                            <ul class="nav nav-tabs mb-3">
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
                                                                <img src="{{$intro->image}}">
                                                                <button class="close"><i class="la la-times"></i></button>
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
                                                            <div class="controls">
                                                                <label for="account-name">{{__('admin.title')}} {{ $lang }}</label>
                                                                <textarea class="form-control" name="title[{{$lang}}]" id="" cols="30" rows="10" placeholder="{{__('admin.write') . __('admin.title')}} {{ $lang }}">{{$intro->getTranslations('title')[$lang]??''}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label for="account-name">{{__('admin.description')}} {{ $lang }}</label>
                                                                <textarea class="form-control" name="description[{{$lang}}]" id="" cols="30" rows="10" placeholder="{{__('admin.write') . __('admin.description')}} {{ $lang }}">{{$intro->getTranslations('description')[$lang]??''}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>

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
        $('.store input').attr('disabled' , true)
        $('.store textarea').attr('disabled' , true)
        $('.store select').attr('disabled' , true)

    </script>
@endsection