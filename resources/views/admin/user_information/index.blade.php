@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
    <h1>Quản lí Khách</h1>
   
    <div class="action-room">
        <a href="" class="btn btn-info ">Thêm</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <!-- {{-- <th scope="col">#</th> --}} -->
                <th scope="col">Tên khách </th>
                <th scope="col">Giới tính</th>
                <th scope="col">Năm sinh</th>
                <th scope="col">Phòng Đang ở</th>
                <th scope="col">email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">cccd</th>
                <th scope="col">Địa chỉ</th>
                
                <th scope="col">Biển số xe</th>
                
                
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
@endsection

