@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))

<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
    <h1>Quản lí Khách</h1>
   
<div class="bg-light  ms-auto">
    <div class="action-room me-3">
        <a href="{{route('user_information.create')}}" class="btn btn-info mt-3 ">Thêm thông tin</a>
    </div>
  
    <form action="{{ route('user_information.index') }}" method="GET" class="mb-4 bg-light me-auto ms-3" novalidate>
  @csrf
  <div class="col-md-2 me-3">
    <input type="text" name="search" class="form-control" placeholder="Tìm theo tên khách" value="{{ htmlspecialchars(request('search')) }}">
    <p></p>
    <button type="submit" class="btn btn-primary">Tìm</button>
  </div>
</form>

    <table class="table">
        <thead>
            <tr>
                <!-- {{-- <th scope="col">#</th> --}} -->
                <th scope="col">Ảnh đại diện </th>
                <th scope="col">Tên khách </th>
                <th scope="col">Phòng đã ở</th>
                <th scope="col">Giới tính</th>
                <th scope="col">Năm sinh</th> 
                <th scope="col">Số điện thoại</th>               
                <th scope="col">email</th>                
                <th scope="col">cccd</th>
                <th scope="col">Địa chỉ</th>                
                <th scope="col">Biển số xe</th>     
                <th scope="col">Ghi chú</th>    
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($user_information as $u )
            <tr> 
            <td><img src="{{$u->user->avatar}}" alt="" width="50px" height="50px" class="rounded-circle"></td>
                <td>{{ $u->user->name }}</td>
                <td>{{ $u->user->room->name }}</td>               
                <td>{{ $u->sex ? 'Nữ' : 'Nam' }}</td>
                <td>{{ $u->year }}</td>
                <td>{{ $u->user->phone }}</td>
                <td>{{ $u->user->email }}</td>                
                <td>{{ $u->user->cccd }}</td>
                <td>{{ $u->user->address }}</td>
                <td>{{ $u->license_plates }}</td>
                <td>{{ $u->note }}</td>
                

                <td>

                <div class="action-button" >
                <a href="{{route('user_information.edit',['user_information'=>$u->id]) }}" class="btn btn-success button-action mx-2"><i class="fa-regular fa-pen-to-square"></i></a>
                   
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection

 