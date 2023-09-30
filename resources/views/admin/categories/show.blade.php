@extends('admin.layout.master')

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="category match-height">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">{{__('admin.show')}}</h4>
                    </div> --}}
                    <div class="card-content">
                        <div class="card-body">
                            <form class="store form-horizontal">
                                <div class="form-body">
                                    <div class="form-body">
                                        <div class="row">
                                            
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
                                                                        <input type="file" accept="image/*" name="image"
                                                                            class="imageUploader">
                                                                    </label>
                                                                    <div class="uploadedBlock">
                                                                        <img src="{{$category->image}}">
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
                                                                    <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="{{$category->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.select_main_section')}}</label>
                                                        <div class="controls">
                                                            <select name="parent_id" class="select2 form-control">
                                                                <option value>{{__('admin.select_section')}}</option>
                                                                @foreach ($categories as $category2)
                                                                    <option {{$category2->id == $category->parent_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                <a href="{{ url()->previous() }}" type="reset"
                                                   class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                            </div>

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
        $('.store input').attr('disabled', true)
        $('.store textarea').attr('disabled', true)
        $('.store select').attr('disabled', true)

    </script>
@endsection