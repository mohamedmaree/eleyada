<div class="position-relative">
    {{-- table loader  --}}
    {{-- <div class="table_loader" >
        {{__('admin.loading')}}
    </div> --}}
    {{-- table loader  --}}
    
    {{-- table content --}}
    <table class="table " id="tab">
        <thead>
            <tr>
                <th>
                    <label class="container-checkbox">
                        <input type="checkbox" value="value1" name="name1" id="checkedAll">
                        <span class="checkmark"></span>
                    </label>
                </th>
                <th>{{__('admin.image')}}</th>
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.email')}}</th>
                <th>{{__('admin.phone')}}</th>
                <th>{{__('admin.ban_status')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productoptions as $productoptions)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $productoptions->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><img src="{{$productoptions->image}}" width="30px" height="30px" alt=""></td>
                    <td>{{ $productoptions->name }}</td>
                    <td>{{ $productoptions->email }}</td>
                    <td>{{ $productoptions->phone }}</td>
                    <td>
                        @if ($productoptions->is_blocked)
                        <span class="btn btn-sm round btn-outline-danger">
                            {{ __('admin.Prohibited') }} <i class="la la-close font-medium-2"></i>
                        </span>
                        @else
                        <span class="btn btn-sm round btn-outline-success">
                            {{ __('admin.Unspoken') }} <i class="la la-check font-medium-2"></i>
                        </span>
                        @endif
                    </td>
                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.productoptions.show', ['id' => $productoptions->id]) }}"><i class="feather icon-eye"></i></a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.productoptions.edit', ['id' => $productoptions->id]) }}"><i class="feather icon-edit"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{ url('admin/productoptions/' . $productoptions->id) }}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($productoptions->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($productoptions->count() > 0 && $productoptions instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$productoptions->links()}}
    </div>
@endif
{{-- pagination  links div --}}
