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
                <th>{{__('admin.title')}}</th>
                <th>{{__('admin.speaker_name')}}</th>
                <th>{{__('admin.discussion_link')}}</th>
                <th>{{__('admin.status')}}</th>
                <th>{{__('admin.control')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discussions as $discussion)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $discussion->id }}">
                        <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><img src="{{$discussion->image}}" width="30px" height="30px" alt=""></td>
                    <td>{{ $discussion->title }}</td>
                    <td>{{ $discussion->speaker_name }}</td>
                    <td>{{ $discussion->discussion_link }}</td>
                    <td>{{ __('admin.'.$discussion->status) }}</td>
                    
                    <td class="product-action"> 
                        <span class="text-primary"><a href="{{ route('admin.discussions.show', ['id' => $discussion->id]) }}"><i class="feather icon-eye"></i></a></span>
                        <span class="action-edit text-primary"><a href="{{ route('admin.discussions.edit', ['id' => $discussion->id]) }}"><i class="feather icon-edit"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{ url('admin/discussions/' . $discussion->id) }}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($discussions->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($discussions->count() > 0 && $discussions instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$discussions->links()}}
    </div>
@endif
{{-- pagination  links div --}}

