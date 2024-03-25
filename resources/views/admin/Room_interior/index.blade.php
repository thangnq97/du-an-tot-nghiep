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

<div class="bg-light  ms-auto">
    <div class=" action-room me-3 ">
    <a href="{{ route('interiors.index') }}" class="btn btn-primary mx-2 mt-3 "> Quay lại</a>
        <a href="{{ route('Roominterior.create') }}" class="btn btn-primary mt-3  ">Thêm chi tiết</a>
    </div>

    
    

    <!-- <form action="{{ route('Roominterior.index') }}" method="GET" class="mb-4 bg-light me-auto ms-3" novalidate>
  @csrf
  <div class="col-md-2 me-3">
    <input type="text" name="search" class="form-control" placeholder="Tìm theo tên nội thất" value="{{ htmlspecialchars(request('search')) }}">
    <p></p>
    <button type="submit" class="btn btn-primary">Tìm</button>
  </div>
</form> -->
<form action="{{ route('Roominterior.index') }}" method="GET">
        @csrf <!-- Thêm token CSRF để bảo vệ biểu mẫu -->
    
        <div class="row align-items-center">
            <div class="col-md-4 mb-2">
                <select class="form-select" name="room" id="room1"> <!-- Đặt tên cho trường select -->
                    <option selected disabled>--Chọn phòng--</option>
                    @foreach ($room as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
          
            <div class="col-md-4 mb-2">
                <select class="form-select" name="interior" id="room2"> <!-- Đặt tên cho trường select -->
                    <option selected disabled>--Tên nội thất--</option>
                    @foreach ($interiors as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="col-md-4 mb-2">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </div>
        </div>
    </form>

        

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
            @foreach ($Room_interiors as $item)
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