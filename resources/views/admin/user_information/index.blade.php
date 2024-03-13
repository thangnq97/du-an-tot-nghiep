@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
    <h1>Quản lí Khách</h1>
   
    <div class="action-room">
        <a href="{{route('user_information.create')}}" class="btn btn-info ">Thêm thông tin</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <!-- {{-- <th scope="col">#</th> --}} -->
                <th scope="col">Tên khách </th>
                <th scope="col">Phòng Đang ở</th>
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
                    <form action="{{ route('user_information.destroy',$u) }}" method="POST">
                        <a href="{{route('user_information.edit',['user_information'=>$u->id]) }}" class="btn btn-success button-action "><i class="fa-regular fa-pen-to-square"></i></a>
                      
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger button-action " onclick="return confirm('bn cos muon xoa')"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

