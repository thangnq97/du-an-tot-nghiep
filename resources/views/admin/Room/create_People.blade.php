@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <form action="{{ route('room.store_people', ['room' =>$room->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="number" class="form-control" id="phone" name="phone">
        </div>
        @error('phone')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="cccd" class="form-label">Số chứng minh nhân dân</label>
            <input type="number" class="form-control" id="cccd" name="cccd">
        </div>
        @error('cccd')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        @error('address')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('room.index') }}" class="btn btn-warning my-3">Trở về</a>
    </form>
@endsection
