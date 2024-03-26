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

            

           

           




            <br>

            <button type="submit" class="btn btn-primary">Gửi</button>
            <a href="{{ route('user_information.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>
        </form>
    </div>
    @endsection