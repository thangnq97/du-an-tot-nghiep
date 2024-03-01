@extends('layouts.admin.layout')

@section('content')
    <h2 class="my-4">Thêm mới thành viên phòng {{ $room->name }}</h2>
    <form action="{{ route('admin.member.store', ['room'=>$room->id]) }}" method="POST" class="w-50">
        @csrf
        <div class="my-3">
            <label for="" class="form-lable">Họ và tên</label>
            <input type="text" class="form-control" name="name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Email</label>
            <input type="text" class="form-control" name="email">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Mật khẩu</label>
            <input type="password" class="form-control" name="password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Điện thoại</label>
            <input type="text" class="form-control" name="phone">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Căn cước công dân</label>
            <input type="text" class="form-control" name="cccd">
            @error('cccd')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Địa chỉ</label>
            <input type="text" class="form-control" name="address">
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <input type="submit" class="btn btn-primary" value="Thêm">
            <a href="{{ route('admin.member.index', ['room'=>$room->id]) }}" class="btn btn-warning">Quay lại</a>
        </div>
    </form>
@endsection