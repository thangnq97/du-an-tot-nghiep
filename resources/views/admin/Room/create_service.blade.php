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
    <form action="{{ route('room.store_service', ['room' => $room->id]) }}" method="POST">  
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên Dịch vụ</label>
            <select class="form-control" name="service_id" id="">
                @foreach ($service as $query)
                <option @foreach ($service_id as $id)
                    @if ($query->id == $id->service_id)
                    hidden disabled
                    @endif
                @endforeach value="{{ $query->id }}">{{ $query->name }} - {{ number_format($query->price) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
        <a href="{{ route('room.show_service', ['room' => $room->id]) }}" class="btn btn-danger ">quay lại</a>
    </form>
@endsection
