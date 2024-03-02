@extends('layouts.admin.layout')
@section('content')
<div>
    @if(\Session::has('msg'))
    <div class="alert alert-success   alert-dismissible fade show" role="alert">
        <strong> {{ \Session::get('msg') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('waters.store') }}" method="POST" enctype="multipart/form-data" class="row">
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Phòng</label>
            <select name="room_id" id="" class="form-control ">
                @foreach ($room as $id => $name)
                <option value="{{ $id }}">{{ $id }}--{{ $name }}</option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Cs nước cũ</label>
            <input class="form-control " type="number" id="pre_water" name="pre_water">
            @error('pre_water')
            <div class="alert alert-danger ">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Cs nước mới</label>
            <input class="form-control " type="number" id="current_water" name="current_water">
            @error('current_water')
            <div class="alert alert-danger ">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nước đã dùng</label><br>
            <input type="number" class="border-0" id="result" name="used_water" readonly>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Ngày tháng</label><br>
            <input type="date" id="" name="date_time" class="form-control ">
            @error('date_time')
            <div class="alert alert-danger ">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Dịch vụ</label>
            <select name="service_id" id="" class="form-control ">
                <option selected >-- Chọn dịch vụ --</option>
                @foreach ($services as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
</div>
<a class="btn btn-warning" href="{{ route('waters.index') }}">Trở về</a>
<button type="submit" class="btn btn-primary ">Thêm</button>
</form>
</div>

<script>
    // Lắng nghe sự kiện khi người dùng thay đổi giá trị của cả hai trường input
    document.getElementById("pre_water").addEventListener("input", updateResult);
    document.getElementById("current_water").addEventListener("input", updateResult);

    function updateResult() {
        // Lấy giá trị từ trường input 1
        var value1 = document.getElementById("pre_water").value;

        // Lấy giá trị từ trường input 2
        var value2 = document.getElementById("current_water").value;


        // Tính tổng hai giá trị
        var sum = parseFloat(value2) - parseFloat(value1);

        // Hiển thị kết quả lên màn hình
        document.getElementById("result").value = sum;
    }

</script>
@endsection
