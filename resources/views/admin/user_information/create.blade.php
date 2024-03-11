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
    <form action="{{route('user_information.store') }}" method="POST" enctype="multipart/form-data">

        @csrf


        <div class="form-group mb-3">
        <label>Tên Khách</label>
        <p></p>
        <select name="user_id" id="" class="form-control">
            @foreach ($users as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
        </div>    

        <div class="form-group mb-3">            
        <label for="name">Giới tính</label>
        <p></p>
        <input type="text" name="sex" id="sex" class="form-control ">
        </div>

        <div class="form-group mb-3">
        <label for="name">Năm sinh</label>
        <p></p>
        <input type="text" name="year" id="year" class="form-control ">
        </div>


        <div class="form-group mb-3">
        <label for="name">Biển số xe</label>
        <p></p>
        <input type="text" name="license_plates" id="license_plates" class="form-control ">
        </div>

        <div class="form-group mb-3">
        <p></p>
        <label for="name">Ghi chú</label>
        <p></p>        
        <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
        </div>



<br>

        <button type="submit" class="btn btn-primary">Gửi</button>
        <a href="{{ route('user_information.index') }}" class="btn btn-warning my-3 m-3">Trở về</a>
    </form>
</div>
@endsection
