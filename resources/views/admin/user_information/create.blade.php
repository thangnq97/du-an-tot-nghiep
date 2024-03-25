@extends('layouts.admin.layout')
@section('content')

@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm thông tin</h6>
    </div>
    <br>
    <div class="card-body">
        <form action="{{route('user_information.store') }}" method="POST" enctype="multipart/form-data">

            @csrf


            <div class="form-group mb-3">
                <label>Tên Khách</label>
                <p></p>
                <select name="user_id" id="" class="form-control">
                    <option value="" selected disabled>--Tên khách-</option>
                    @foreach ($users as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    <p></p>
                    @endforeach
                </select>
                <p></p>
                @error('user_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Giới tính</label>
                <p></p>
                <input type="radio" name="sex" id="status-1" value="0">
                <label for="">Nam </label>

                <input type="radio" name="sex" id="status-2" value="1">
                <label for=""> Nữ</label>
                <p></p>
                @error('sex')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>

            <div class="form-group mb-3">
                <label for="birthday">Ngày sinh:</label>
                <p></p>
                <input type="date" id="year" name="year" class="form-control ">
                <p></p>
                @error('year')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group mb-3">
                <label for="name">Biển số xe</label>
                <p></p>
                <input type="text" name="license_plates" id="license_plates" class="form-control ">
                <p></p>
                @error('license_plates')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <p></p>
                <label for="name">Ghi chú</label>
                <p></p>
                <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
                <p></p>
                @error('note')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>



            <br>

            <button type="submit" class="btn btn-primary">Gửi</button>
            <a href="{{ route('user_information.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>
        </form>
    </div>
    @endsection