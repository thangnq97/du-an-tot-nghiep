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
    <form action="{{ route('service.update', $service) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên Dịch vụ</label>
            <input type="text" value="{{ $service->name }}" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá dịch vụ</label>
            <input type="number" value="{{ $service->price }}" class="form-control" id="price" name="price">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Phương thức tính</label>
            <select class="form-control" name="method" id="">
                <option @if ($service->method == 0) selected @endif value="0">Số người</option>
                <option @if ($service->method == 1) selected @endif value="1">Số đồng hồ</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
@endsection
