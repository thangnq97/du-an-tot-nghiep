@extends('layouts.admin.layout')
@section('content')

@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif


<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm nội thất mới</h6>
    </div>

    <br>

    <div class="card-body">
        <form action="{{ route('interiors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name">Tên nội thất</label>
                <p></p>
                <input type="text" name="name" id="name" class="form-control ">
                <p></p>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantitys">Số lượng</label>
                <p></p>
                <input type="text" name="quantitys" id="quantitys" class="form-control ">
                <p></p>
                @error('quantitys')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Gửi </button>
            <a href="{{ route('interiors.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>

        </form>
    </div>



    @endsection