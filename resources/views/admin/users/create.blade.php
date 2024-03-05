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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm thông tin</h6>
    </div>
    <br>
    <div class="card-body">
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

        @csrf


        <div class="form-group mb-3">
        <label for="name">Tên Khách</label>
        <p></p>
        <input type="text" name="name" id="name" class="form-control ">
        </div>


        <div class="form-group mb-3">
            <label>Tên phòng</label>
            <p></p>
            <select name="room_id" id="" class="form-control">
                @foreach ($rooms as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            
        <label for="name">email</label>
        <p></p>
<input type="text" name="email" id="email" class="form-control ">
</div>

<div class="form-group mb-3">
<label for="name">Số điện thoại</label>
<p></p>
<input type="text" name="phone" id="phone" class="form-control ">
</div>


<div class="form-group mb-3">
<label for="name">cccd</label>
<p></p>
<input type="text" name="cccd" id="cccd" class="form-control ">
</div>

<div class="form-group mb-3">
    <p></p>
<label for="name">Địa chỉ</label>
<p></p>
<input type="text" name="address" id="address" class="form-control ">
</div>

<div class="form-group mb-3">
    <label>Vai trò</label>
    <p></p>
    <select name="role_id" id="" class="form-control">
        @foreach ($role as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    </select>
</div>

<br>

        <button type="submit" class="btn btn-primary">Gửi</button>
        <a href="{{ route('users.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>
    </form>
</div>
@endsection
