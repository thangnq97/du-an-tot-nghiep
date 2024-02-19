@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
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
                    <h6><a href="{{ route('room.createpeople') }}" class="btn btn-primary ">Thêm Khách</a></h6>
                    <h6 class="card-subtitle mb-2 text-muted">Số lượng : {{ $query->member_quantity }}</h6>
                    <h6 class="card-text"> Số lượng giới hạn : {{ $query->member_maximum }}</h6>
                    <h6 class="card-text"> Giá tiền : {{ number_format($query->price) }}</h6>
                    <div class="">
                        <a href="{{ route('room.edit', $query) }}" class="btn btn-primary ">Chỉnh sửa</a>
                        <form action="{{ route('room.destroy', $query) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('Bạn có muốn xóa không')">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
    <script></script>
