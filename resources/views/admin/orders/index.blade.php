@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.orders.create') }}" 
    deletebutton="{{ route('admin.orders.deleteAll') }}" 
    :searchArray="[
        'order_num' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.order_num') , 
        ] ,
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ] ,
        'phone_number' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.phone') , 
        ] ,
        'address' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.address') , 
        ] ,
        'status' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.delivered') , 
                'id' => 'delivered' , 
              ],
              '2' => [
                'name' => __('admin.in_progress') , 
                'id' => 'in_progress' , 
              ],
              '3' => [
                'name' => __('admin.canceled') , 
                'id' => 'canceled' , 
              ],
            ] , 
            'input_name' => __('admin.status')  , 
        ] ,
        'doctor_id' => [
            'input_type' => 'select' , 
            'rows'       => $doctors , 
            'input_name' => __('admin.doctor') , 
        ],
        'region_id' => [
            'input_type' => 'select' , 
            'rows'       => $regions , 
            'input_name' => __('admin.region') , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a> --}}
    </x-slot>

    <x-slot name="tableContent">
        <div class="table_content_append card">
            {{-- table content will appends here  --}}
        </div>
    </x-slot>
</x-admin.table>


    
@endsection

@section('js')

    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => url('admin/orders')])
@endsection
