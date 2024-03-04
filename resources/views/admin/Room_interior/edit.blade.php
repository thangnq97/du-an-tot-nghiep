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
                <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('Roominterior.update',$room_interior) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Tên phòng</label>
                            <p></p>
                            <select name="room_id" id="" class="form-control">
                                @foreach ($rooms as $id => $name)
                                <option value="{{ $id }}"@if ($room_interior->room_id == $id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Tên nội thất</label>
                            <p></p>
                            <select name="interior_id" id="" class="form-control">
                                @foreach ($interiors as $id => $name)
                                <option value="{{ $id }}"@if ($room_interior->interior_id == $id) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
<br>


                        <div class="form-group">
                            <label>Số lượng (chiếc, cái)</label>
                            <p></p>
                            <input type="text" class="form-control" placeholder="quantity" name="quantity" value="{{ $room_interior->quantity }}">
                        </div>
<br>
                        <div class="form-group">
                            <label>Giá (VND)</label>
                            <p></p>
                            <input type="text" class="form-control" placeholder="price" name="price" value="{{ $room_interior->price }}">
                        </div>

<br>
                        <div class="form-group">
                            <p></p>
                            <label>Tình trạng (%)</label> <br>
                            <input type="text" class="form-control" placeholder="status" name="status" value="{{ $room_interior->status }}">
                        </div>
<br>
                        <button type="submit" class="btn btn-primary">Lưu </button>
                        <a href="{{ route('Roominterior.index') }}" class="btn btn-danger m-3">danh sách</a>
                    </form>
                </div>
            </div>
        </div>

    @endsection