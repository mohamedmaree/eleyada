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
    #infowindow-content {
        display: none;
    }

    #map1 #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-container {
        z-index: 9999999;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #search1 {
        background-color: #fff;
        font-size: 15px;
        font-weight: 300;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        /* left: 0 !important; */
        margin-right: 13px;
        width: 50%;
        top: 17px !important;
        right: 50px !important;
        /* z-index: 99 !important; */
        height: 30px;
        margin: auto;
        /* border: 1px solid #5e65a1; */
        border-radius: 5px;
    }
    #search1:focus {
        border-color: #4d90fe;
    }
    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    #target {
        width: 250px;
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
                    <h4 class="card-title">{{__('admin.add') . ' ' . __('admin.clinic')}}</h4>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.clinics.store')}}" class="store form-horizontal" novalidate>
                            @csrf
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
                                    {{--    <div class="tab-content">
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
                                                    </div>
                                                @endforeach
                                            </div> --}}

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.name') }}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="{{ __('admin.name') }}" required
                                                            data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('admin.doctor')}}</label>
                                                    <div class="controls">
                                                        <select name="doctor_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                            <option value>{{__('admin.doctor')}}</option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.booking_link') }}</label>
                                                    <div class="controls">
                                                        <input type="url" name="booking_link" class="form-control"
                                                            placeholder="{{ __('admin.booking_link') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.location_link') }}</label>
                                                    <div class="controls">
                                                        <input type="url" name="location_link" class="form-control"
                                                            placeholder="{{ __('admin.location_link') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{ __('admin.address') }}</label>
                                                    <div class="controls">
                                                        <input type="text" id="address1" name="address" class="form-control" placeholder="{{ __('admin.address') }}" >
                                                        <input id="search1" class="controls" type="text" placeholder="search">
                                                        <div id="map1" class="store_map" style="width: 100%;height:250px;"></div>
                                                        <input type="hidden" id="lat1" name="lat" class="form-control" >
                                                        <input type="hidden" id="lng1" name="lng" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <span class="mt-3 mb-2 col-12 w-100 text-center phone_numbers">{{__('admin.phone_numbers')}}</span>
                                            <div class="col-12 append_here phone_numbers">
                                                <div class="col-12 row">
                                                    <div class="col-md-8 col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-column">{{__('admin.phone')}}</label>
                                                            <div class="controls">
                                                                <input type="number"  name="numbers[]" class="form-control" placeholder="{{__('admin.phone')}}"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="trash ">
                                                        <span class="btn btn-danger form-control text-center removeeventmore" style="margin-top: 29px"><i class="fa fa-trash-o"></i> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn gradient-light-primary text-white waves-effect waves-light m-auto add_name phone_numbers">{{__('admin.add_number')}}</button>

                                    {{--  to create languages tabs uncomment that --}}
                                    {{-- </div> --}}



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
            <div class="col-md-8 col-6">
                <div class="form-group">
                    <label for="first-name-column">{{__('admin.phone')}}</label>
                    <div class="controls">
                        <input type="text"  name="numbers[]" class="form-control" placeholder="{{__('admin.phone')}}"  >
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
    <?php $google_places_key =  $settings['google_places'] ;?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{$google_places_key}}&libraries=places&language=ar"></script>
    <script type="text/javascript">
        
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
    //************ FIRST MAP ********************//
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            (position) => {
                var map; var marker;
                var geocoder  = new google.maps.Geocoder();
                // infoWindow.setPosition(pos);
                // infoWindow.setContent("Location found.");
                // infoWindow.open(map);
                // var x= position.coords.latitude;
                myLatlng= new google.maps.LatLng( position.coords.latitude,  position.coords.longitude);
                    var mapOptions = {
                        zoom: 14,
                        center: myLatlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
    
                map = new google.maps.Map(document.getElementById("map1"), mapOptions);
                marker = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true
                });
                $('#lat1').val(marker.getPosition().lat());
                $('#lng1').val(marker.getPosition().lng());
    
                /*start search box*/
                // Create the search box and link it to the UI element.
                var input = document.getElementById('search1');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();
                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        marker.setPosition(place.geometry.location);
                        $('#address1').val(place.formatted_address);
                        $('#lat1').val(place.geometry.location.lat());
                        $('#lng1').val(place.geometry.location.lng());
                        if(place.geometry.viewport) {
                            bounds.union(place.geometry.viewport);
                        }else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
                /*end search box*/
                google.maps.event.addListener(marker, 'dragend', function() {
                    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                        // if (status == google.maps.GeocoderStatus.OK) {
                            // if (results[0]) {
                                $('#address1').val(marker.getPosition().formatted_address);
                                $('#lat1').val(marker.getPosition().lat());
                                $('#lng1').val(marker.getPosition().lng());
                            // }
                        // }
                    });
                });
            },(error) => {
                var message = '{{ __('admin.open_location') }}';
                alert(message);
                // function initMap(){
                    var map; var marker;
                    var myLatlng  = new google.maps.LatLng(29.2259, 47.5892);
                    var geocoder  = new google.maps.Geocoder();
                    var mapOptions = {
                        zoom: 14,
                        center: myLatlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
    
                    map = new google.maps.Map(document.getElementById("map1"), mapOptions);
                    marker = new google.maps.Marker({
                        map: map,
                        position: myLatlng,
                        draggable: true
                    });
    
            /*start search box*/
                    // Create the search box and link it to the UI element.
                    var input = document.getElementById('search1');
                    var searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                    });
                    searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();
                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                        }
                        marker.setPosition(place.geometry.location);
                        $('#address1').val(place.formatted_address);
                        $('#lat1').val(place.geometry.location.lat());
                        $('#lng1').val(place.geometry.location.lng());
                        if(place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                        }else {
                        bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                    });
            /*end search box*/
                    google.maps.event.addListener(marker, 'dragend', function() {
                        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                            // if (status == google.maps.GeocoderStatus.OK) {
                                // if (results[0]) {
                                    $('#address1').val(marker.getPosition().formatted_address);
                                    $('#lat1').val(marker.getPosition().lat());
                                    $('#lng1').val(marker.getPosition().lng());
                                // }
                            // }
                        });
                    });
    
                // }
                // google.maps.event.addDomListener(window, 'load', initMap);
    
            }
        );
    
    }else{
        // function initMap(){
            var map; var marker;
            var myLatlng  = new google.maps.LatLng(29.2259, 47.5892);
            var geocoder  = new google.maps.Geocoder();
            var mapOptions = {
                zoom: 14,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
    
            map = new google.maps.Map(document.getElementById("map1"), mapOptions);
            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true
            });
    
    /*start search box*/
            // Create the search box and link it to the UI element.
            var input = document.getElementById('search1');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
            });
            searchBox.addListener('places_changed', function() {
              var places = searchBox.getPlaces();
              // For each place, get the icon, name and location.
              var bounds = new google.maps.LatLngBounds();
              places.forEach(function(place) {
                if (!place.geometry) {
                  console.log("Returned place contains no geometry");
                  return;
                }
                marker.setPosition(place.geometry.location);
                $('#address1').val(place.formatted_address);
                $('#lat1').val(place.geometry.location.lat());
                $('#lng1').val(place.geometry.location.lng());
                if(place.geometry.viewport) {
                  bounds.union(place.geometry.viewport);
                }else {
                  bounds.extend(place.geometry.location);
                }
              });
              map.fitBounds(bounds);
            });
    /*end search box*/
            google.maps.event.addListener(marker, 'dragend', function() {
                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    // if (status == google.maps.GeocoderStatus.OK) {
                        // if (results[0]) {
                            $('#address1').val(marker.getPosition().formatted_address);
                            $('#lat1').val(marker.getPosition().lat());
                            $('#lng1').val(marker.getPosition().lng());
                        // }
                    // }
                });
            });
    
        // }
        // google.maps.event.addDomListener(window, 'load', initMap);
    
    }
    </script>
    @endsection
    