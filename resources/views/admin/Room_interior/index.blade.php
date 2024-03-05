<!-- kế thừa layout -->
@extends('layouts.admin.layout')
@section('content')
<!-- thông báo lỗi -->
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif

<h1>Chi Tiết Nội Thất</h1>

<br>

<div class="bg-light">
    <div class="action-room">
        <a href="{{ route('Roominterior.create') }}" class="btn btn-primary m-2  ">Thêm</a>
    </div>

    <br>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tên phòng</th>
                <th scope="col">Tên nội thất</th>
                <th scope="col">Số lượng (chiếc, cái)</th>
                <th scope="col">Giá (VND)</th>
                <th scope="col">Tình trạng (%)</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Hoạt động</th>

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
                <td>{{ $item->description}}</td>
                <!-- from nút xóa với sửa  -->
                <td>
                    <div class="action-button">
                        <form action="{{ route('Roominterior.destroy',$item) }}" method="POST">
                            <a href="{{ route('Roominterior.edit',['Roominterior'=>$item->id]) }}" class="btn btn-success button-action "><i class="fa-regular fa-pen-to-square"></i></a>

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger button-action " onclick="return confirm('Bạn có muốn xóa không')"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>



    </table>

</div>


@endsection