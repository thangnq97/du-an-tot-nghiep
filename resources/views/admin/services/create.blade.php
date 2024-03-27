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
    <form action="{{ route('service.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên Dịch vụ</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá dịch vụ</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Phương thức tính</label>
            <select class="form-control" name="method" id="">
                <option value="0">Theo người</option>
                <option value="1">Theo Phòng</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
        <a href="{{ route('service.index') }}" class="btn btn-warning my-3">Trở về</a>
    </form>
@endsection
