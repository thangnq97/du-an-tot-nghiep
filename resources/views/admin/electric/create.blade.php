@extends('layouts.admin.layout')
@section('content')
    <h2>Thêm</h2>
    {{-- <div>
        @if (Session::has('msg'))
            <div class="btn btn-success ">{{ Session::get('msg') }}</div>
        @endif

        @if ($errors->any())
        <ul class="btn btn-danger ">
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div> --}}
    <div>
        @if(\Session::has('msg'))
        <div class="alert alert-success   alert-dismissible fade show" role="alert">
            <strong> {{ \Session::get('msg') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <form action="{{ route('electric.store') }}" method="POST" enctype="multipart/form-data" class="form-control">
        @csrf
            <div class="mb-3">
                <label for="">Phòng</label>
                <select name="room_id" class="form-select" id="">
                    @foreach ($rooms as $id=>$name)
                        <option value="{{ $id }}">{{ $id.'_'.$name }}</option>
                    @endforeach

                   
                </select>
               
            </div>
            <div class="mb-3">
                <label for="pre_electricity">Cs điện cũ</label>
                <input type="number" name="pre_electricity" class="form-control" id="input1">
                @error('pre_electricity')
                <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
            </div>
            
            <div class="mb-3">
                <label for="current_electricity">Cs điện mới</label>
                <input type="number" name="current_electricity" class="form-control" id="input2">
                @error('current_electricity')
                <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
            </div>
           
            <div class="mb-3">
                <label for="used_electricity">Điện sử dụng</label>
                <input type="number" name="used_electricity" class="form-control" id="result">
                
                  {{-- <p id="result"></p> --}}
            </div>
           
            <div class="mb-3">
                <label for="date_time">Ngày tháng</label>
                <input type="date" name="date_time" class="form-control" id="">
                @error('date_time')
                <div class="alert alert-danger">{{ $message }}</div>
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
            
            <a href="{{ route('electric.index') }}" class="btn btn-warning ">Quay lại</a>
            <button type="submit" class="btn btn-primary  ">Thêm</button>
    </form>

    <script>
        // Lắng nghe sự kiện khi người dùng thay đổi giá trị của cả hai trường input
     document.getElementById("input1").addEventListener("input", updateResult);
     document.getElementById("input2").addEventListener("input", updateResult);
     
     function updateResult() {
       // Lấy giá trị từ trường input 1
       var value1 = document.getElementById("input1").value;
     
       // Lấy giá trị từ trường input 2
       var value2 = document.getElementById("input2").value;
     
       // Tính tổng hai giá trị
       var sum = parseFloat(value2) - parseFloat(value1);
     
       // Hiển thị kết quả lên màn hình
       document.getElementById("result").value = sum;
     }
     
         </script>
@endsection