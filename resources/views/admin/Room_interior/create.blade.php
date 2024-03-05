<!-- kế thừa layuot  -->
@extends('layouts.admin.layout')
@section('content')
<!-- thông báo lỗi validate  -->
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

    <div class="table-responsive card-body">

        <form action="{{ route('Roominterior.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Tên phòng</label>
                <p></p>
                <select name="room_id" id="" class="form-control">
                    @foreach ($rooms as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Tên nội thất</label>
                <p></p>
                <select name="interior_id" id="" class="form-control">
                    @foreach ($interiors as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Số lượng (chiếc, cái)</label>
                <p></p>
                <input type="text" class="form-control" placeholder="Số lượng" name="quantity">
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Giá (VND)</label>
                <p class="text-danger ">*Lớn hơn 1000 VND</p>
                <input type="text" class="form-control" placeholder="Giá" name="price">
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Tình trạng (%)</label>
                <p></p>
                <input type="text" class="form-control" placeholder="Tình trạng " name="status">
            </div>

            <br>

            <div class="form-group mb-3">
                <label>Mô tả</label>
                <p></p>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Gửi</button>
            <a href="{{ route('Roominterior.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>
            
        </form>

    </div>
</div>

@endsection