@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
<h1>chi tiết</h1>

<a href="{{ route('Roominterior.create') }}" class="btn btn-info ">Thêm</a>

<table class="table">
<thead>
    <tr>
        <th>Tên phòng</th>
        <th>Tên nội thất</th>
        <th>Số lượng (chiếc, cái)</th>
        <th>Giá (VND)</th>
        <th>Tình trạng (%)</th>


        <th>Hoạt động</th>

    </tr>
</thead>
<tbody>
    @foreach ($data as $item)
    {{-- @dd($item->toArray()) --}}

    <tr>
        <td>{{ $item->room->name }}</td>
        <td>{{ $item->interior->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->price }}</td>
        <td>{{ $item->status }}</td>



        <td>
            <form action="{{ route('Roominterior.destroy',$item) }}" method="POST">
                <a href="{{ route('Roominterior.edit',['Roominterior'=>$item->id]) }}" class="btn btn-success button-action "><i class="fa-regular fa-pen-to-square"></i></a>

                @csrf
                @method('DELETE')
                <button class="btn btn-danger button-action " onclick="return confirm('bn cos muon xoa')"><i class="fa-solid fa-trash-can"></i></button>
            </form>
        </td>
    </tr>
@endforeach

</tbody>



</table>




@endsection
