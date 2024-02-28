@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <h1>Quản lí phòng</h1>
    <hr>
    <div class="action-room">
        <a href="{{ route('room.create') }}" class="btn btn-primary room-button">Thêm Phòng</a>
        <a href="" class="btn btn-success room-button">Sửa Phòng</a>
        <a href="" class="btn btn-danger room-button">Xóa Phòng</a>
    </div>
    <div class="row">
        @foreach ($data as $query)
            <div class="card card-room" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-house"> {{ $query->name }}</i></h5>
                    <h6><a href="{{ route('room.createpeople') }}" class="btn btn-primary text-room ">Thêm Khách</a></h6>
                    <h6 class="card-text text-room">Số lượng : {{ $query->member_quantity }}</h6>
                    <h6 class="card-text text-room"> Số lượng giới hạn : {{ $query->member_maximum }}</h6>
                    <h6 class="card-text text-room"> Giá tiền : {{ number_format($query->price) }}</h6>
                    <div class="action-button">
                        <a href="{{ route('room.edit', $query) }}" class="btn btn-primary button-action">
                            <i class="fa-regular fa-pen-to-square"></i></a>
                        <form action="{{ route('room.destroy', $query) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger button-action" type="submit" onclick="return confirm('Bạn có muốn xóa không')">
                                <i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
    <script></script>
