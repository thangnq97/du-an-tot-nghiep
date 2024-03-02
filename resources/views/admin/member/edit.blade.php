@extends('layouts.admin.layout')

@section('content')
    <h2 class="my-4">Sửa thông tin thành viên phòng {{ $room->name }}</h2>
    <form action="{{ route('admin.member.update', ['room'=>$room->id, 'id'=>$user->id]) }}" method="POST" class="w-50">
        @csrf
        @method('PUT')
        <div class="my-3">
            <label for="" class="form-lable">Họ và tên</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Mật khẩu</label>
            <input type="password" class="form-control" name="password" value="{{ $user->password }}">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Điện thoại</label>
            <input type="phone" class="form-control" name="phone" value="{{ $user->phone }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Căn cước công dân</label>
            <input type="cccd" class="form-control" name="cccd" value="{{ $user->cccd }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <label for="" class="form-lable">Địa chỉ</label>
            <input type="address" class="form-control" name="address" value="{{ $user->address }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="my-3">
            <input type="submit" class="btn btn-success" value="Sửa">
            <a href="{{ route('admin.member.index', ['room'=>$room->id]) }}" class="btn btn-warning">Quay lại</a>
        </div>
    </form>
@endsection