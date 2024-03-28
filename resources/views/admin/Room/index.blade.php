@extends('layouts.admin.layout')
@section('content')
    <h1>Quản lí phòng</h1>
    <hr>
    <div class="bg-light">
        @if (Session::has('msg'))
            <div class="alert alert-danger">
                {{ Session::get('msg') }}
            </div>
        @endif
        {{-- #00E396 --}}
        <div class="action-room">
            <a href="{{ route('room.create') }}" class="btn btn-primary room-button m-2">Thêm Phòng</a>
        </div>
        <div class="row ">
            @foreach ($data as $query)
                <div class="col-3 ">
                    <div class="card card-room " style="width: 15rem;">
                        <div @if ($query->member_quantity == $query->member_maximum) style="background-color : #f7a0a0" 
                            @elseif ($query->member_quantity > 0) style="background-color : #b5dceb" @endif
                            class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-house"> {{ $query->name }}</i></h4>
                            <h6><a href="{{ route('room.create_people', $query) }}" class="btn btn-primary text-room ">Thêm
                                    Khách</a>
                            </h6>
                            <h6 class="card-text text-room">Số lượng : {{ $query->member_quantity }}</h6>
                            <h6 class="card-text text-room"> Số lượng giới hạn : {{ $query->member_maximum }}</h6>
                            <h6 class="card-text text-room "> Giá tiền : <span
                                    class="@if ($query->member_quantity == $query->member_maximum) text-light @else text-danger @endif">{{ number_format($query->price) }}
                                    VNĐ</span></h6>
                            <div class="action-button">
                                @if ($query->member_quantity > 0)
                                    <a href="{{ route('admin.member.index', ['room' => $query->id]) }}"
                                        class="btn btn-info button-action"><i class="fa-solid fa-eye"></i></a>
                                @endif
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
