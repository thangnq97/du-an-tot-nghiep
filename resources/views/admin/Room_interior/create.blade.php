<!-- kế thừa layuot  -->
@extends('layouts.admin.layout')
@section('content')
<!-- thông báo lỗi validate  -->
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm thông tin</h6>
    </div>

    <div class="table-responsive card-body">

        <form action="{{ route('Roominterior.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Tên phòng</label>
                <p></p>
                <select name="room_id" id="" class="form-control">
                    <option value="" selected disabled>--Tên phòng-</option>
                    @foreach ($rooms as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <p></p>
                @error('room_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Tên nội thất</label>
                <p></p>
                <select name="interior_id" id="" class="form-control">
                    <option value="" selected disabled>--Tên nôị thất-</option>
                    @foreach ($interiors as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <p></p>
                @error('interior_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Số lượng (chiếc, cái)</label>
                <p></p>
                <input type="text" class="form-control" placeholder="Số lượng" name="quantity">
                <p></p>
                @error('quantity')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Giá (VND)</label>
                <input type="text" class="form-control" placeholder="Giá" name="price">
                <p></p>
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Tình trạng (%)</label>
                <p></p>
                <input type="text" class="form-control" placeholder="Tình trạng " name="status">
                <p></p>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <p></p>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                <p></p>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Gửi</button>
            <a href="{{ route('Roominterior.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>

        </form>

    </div>
</div>

@endsection