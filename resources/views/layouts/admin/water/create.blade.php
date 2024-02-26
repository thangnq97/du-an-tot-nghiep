@extends('layouts.admin.layout')
@section('content')
<div>
     <h2 class="text-center ">Tính só điện</h2>
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
                    <option  value="{{ $id }}">{{ $id }}--{{ $name }}</option>
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
                <input   type="number" class="border-0" id="result" name="used_water" readonly>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ngày tháng</label><br>
                <input   type="date" id="" name="date_time" class="form-control ">
            @error('date_time')
                <div class="alert alert-danger ">{{ $message }}</div>
            @enderror
            </div>

        </div>
            <a class="btn btn-primary" href="{{ route('waters.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
  <path d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5"/>
</svg></a>
            <button type="submit" class="btn btn-success ">Thêm</button>
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


