@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
    <h1>Quản lí Khách</h1>
   
    <div class="action-room">
        <a href="{{ route('users.create') }}" class="btn btn-info ">Thêm</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Tên khách </th>
                <th scope="col">Phòng Đang ở</th>
                <th scope="col">email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">cccd</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Vai trò</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $t )
            <tr>

                <td>{{ $t->name }}</td>
                <td>{{ $t->room->name }}</td>
                <td>{{ $t->email }}</td>
                <td>{{ $t->phone }}</td>
                <td>{{ $t->cccd }}</td>
                <td>{{ $t->address }}</td>
                <td>{{ $t->role->name }}</td>

                <td>

                <div class="action-button" >
                    <form action="{{ route('users.destroy',$t) }}" method="POST">
                        <a href="{{ route('users.edit',['user'=>$t->id]) }}" class="btn btn-success button-action "><i class="fa-regular fa-pen-to-square"></i></a>
                      
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
<script></script>
