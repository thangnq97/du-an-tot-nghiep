@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))

<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
    <h1>Quản lí Khách</h1>
   
<div class="bg-light  ms-auto">
  
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
                <th scope="col">Số điện thoại</th>               
                <th scope="col">email</th>
                <th scope="col">password</th>  
                <th scope="col">cccd</th>
                <th scope="col">Địa chỉ</th>   
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $u )
            <tr> 
            <td><img src="{{$u->avatar}}" alt="" width="50px" height="50px" class="rounded-circle"></td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->room->name }}</td>
                <td>{{ $u->phone }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->password }}</td>   
                <td>{{ $u->cccd }}</td>
                <td>{{ $u->address }}</td> 
                <!-- <td>

                <div class="action-button" >
                <a href="{{route('user_information.edit',['user_information'=>$u->id]) }}" class="btn btn-success button-action mx-2"><i class="fa-regular fa-pen-to-square"></i></a>
                   
                    </div>
                </td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection

 