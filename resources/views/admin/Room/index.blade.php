@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <h1>Quản lí phòng</h1>
    <hr>
    <div class="bg-light">
        <div class="action-room">
            <a href="{{ route('room.create') }}" class="btn btn-primary room-button m-2">Thêm Phòng</a>
            <a href="" class="btn btn-success room-button m-2">Sửa Phòng</a>
            <a href="" class="btn btn-danger room-button m-2">Xóa Phòng</a>
        </div>
        <div class="row ">
            @foreach ($data as $query)
                <div class="col-3 ">
                    <div class="card card-room " style="width: 15rem;">
                        <div @if ($query->member_quantity > 0) style="background-color : #b5dceb" @endif class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-house"> {{ $query->name }}</i></h4>
                            <h6><a @if ($query->member_quantity > 0)
                                style = " visibility:hidden"
                            @endif href="{{ route('room.create_people', $query) }}" class="btn btn-primary text-room ">Thêm Khách</a>
                            </h6>
                            <h6 class="card-text text-room">Số lượng : {{ $query->member_quantity }}</h6>
                            <h6 class="card-text text-room"> Số lượng giới hạn : {{ $query->member_maximum }}</h6>
                            <h6 class="card-text text-room "> Giá tiền : <span
                                    class="text-danger">{{ number_format($query->price) }} VNĐ</span></h6>
                            <div class="action-button">
                                <a @if ($query->member_quantity <= 0) hidden @endif href="{{ route('admin.member.index', ['room' => $query->id]) }}"
                                    class="btn btn-info button-action"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('room.edit', $query) }}" class="btn btn-success button-action">
                                    <i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('room.destroy', $query) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger button-action" type="submit"
                                        onclick="return confirm('Bạn có muốn xóa không')">
                                        <i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
    <script></script>
