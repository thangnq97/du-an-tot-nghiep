@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <h1>Thêm phòng</h1>
    <hr>
    <form action="{{ route('room.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên phòng</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="price" class="form-label">Giá Phòng</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>
        @error('price')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="member_maximum" class="form-label">Số lượng người giới hạn</label>
            <input type="text" class="form-control" id="name" name="member_maximum">
        </div>
        @error('member_maximum')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="width" class="form-label">Chiều rộng</label>
            <input type="text" class="form-control" id="name" name="width">
        </div>
        @error('width')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="length" class="form-label">Chiều dài</label>
            <input type="text" class="form-control" id="name" name="length">
        </div>
        @error('length')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
        <a href="{{ route('room.index') }}" class="btn btn-warning my-3">Trở về</a>
    </form>
@endsection
