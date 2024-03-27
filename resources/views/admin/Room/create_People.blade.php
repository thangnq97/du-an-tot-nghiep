@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    @if (Session::has('err'))
        <div class="alert alert-danger">
            {{ Session::get('err') }}
        </div>
    @endif
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{ route('room.store_people', ['room' =>$room->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="text" class="form-control" id="name" name="email">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Mật khẩu</label>
            <input type="text" class="form-control" id="name" name="password">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Số điện thoại</label>
            <input type="number" class="form-control" id="price" name="phone">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Số chứng minh nhân dân</label>
            <input type="number" class="form-control" id="price" name="cccd">
        </div>
        <div class="mb-3">
            <label for="member_maximum" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="name" name="address">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('room.index') }}" class="btn btn-warning my-3">Trở về</a>
    </form>
@endsection
