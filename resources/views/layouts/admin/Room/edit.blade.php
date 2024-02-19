@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
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
    <form action="{{ route('room.update', $room) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên phòng</label>
            <input value="{{ $room->name }}" type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá Phòng</label>
            <input value="{{ $room->price }}" type="number" class="form-control" id="price" name="price">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Trạng thái</label>
            <select class="form-control" name="status" id="">
                <option @if ($room->status == 0) selected @endif value="0">Đang thuê</option>
                <option @if ($room->status == 1) selected @endif value="1">Đang trống</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="member_quantity" class="form-label">Số lượng người</label>
            <input value="{{ $room->member_quantity }}" type="text" class="form-control" id="name"
                name="member_quantity">
        </div>
        <div class="mb-3">
            <label for="member_maximum" class="form-label">Số lượng người giới hạn</label>
            <input value="{{ $room->member_maximum }}" type="text" class="form-control" id="name"
                name="member_maximum">
        </div>
        <div class="mb-3">
            <label for="width" class="form-label">Chiều rộng</label>
            <input value="{{ $room->width }}" type="text" class="form-control" id="name" name="width">
        </div>
        <div class="mb-3">
            <label for="length" class="form-label">Chiều dài</label>
            <input value="{{ $room->length }}" type="text" class="form-control" id="name" name="length">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="" cols="30" rows="10"
                class="form-control">{{ $room->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
@endsection
