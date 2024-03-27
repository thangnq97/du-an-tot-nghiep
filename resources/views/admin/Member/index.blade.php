@extends('layouts.admin.layout')
@section('content')
    {{-- @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif --}}
    <h1>Quản lí dịch vụ</h1>
    <hr>
    <div class="action-room">
        <a href="" class="btn btn-primary ">Thêm Khách Hàng</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Tên</th>
                {{-- <th scope="col">Loại dịch vụ</th> --}}
                <th scope="col">Số Diện Thoại</th>
                <th scope="col">email</th>
                <th scope="col">cccd</th>
                <th scope="col">Địa Chỉ</th>
                <th scope="col">Vai Trò</th>
                <th scope="col">Mật Khẩu</th>
                <th scope="col">avatar</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
@endsection
<script></script>
