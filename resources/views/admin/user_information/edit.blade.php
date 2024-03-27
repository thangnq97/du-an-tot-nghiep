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
        <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin</h6>
    </div>
    <br>
    <div class="card-body">
        <form action="{{ route('user_information.update',$user_information) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Tên khách</label>
                <p></p>
                <select name="user_id" id="" class="form-control">
                    @foreach ($users as $id => $name)
                    <option value="{{ $id }}" @if ($user_information->user_id == $id) selected @endif>{{ $name }}</option>
                    @endforeach
                    <p></p>
                    @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </select>
            </div>

           
            <br>

<div class="form-group mb-3">
    <label>Email</label>
    <input type="text" class="form-control" placeholder="abc@gmail.com" name="price">
    <p></p>
    @error('price')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<br>

<div class="form-group mb-3">
    <label>Số điện thoại</label>
    <p></p>
    <input type="text" class="form-control" placeholder="0XXXXX " name="status">
    <p></p>
    @error('status')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label>Số điện thoại</label>
    <p></p>
    <input type="text" class="form-control" placeholder="0XXXXX " name="status">
    <p></p>
    @error('status')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


            
           



            <br>

            <button type="submit" class="btn btn-primary">Gửi</button>
            <a href="{{ route('user_information.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>
        </form>
    </div>
    @endsection