@extends('layouts.admin.layout')
@section('content')
    <h2>Sửa</h2>
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
    </div> --}}
    <form action="{{ route('electric.update',$electricity_usage) }}" method="POST" enctype="multipart/form-data" class="form-control">
        @csrf
        @method('PUT')
            <div class="mb-3">
                <label for="room_id">Phòng</label>
                <select name="room_id" id="room_id" class="form-select" >
                    @foreach ($rooms as $id => $name)
                    <option value="{{ $id }}"
                        @if ($electricity_usage->rooms_id) @selected(true) @endif>{{ $id . '_' . $name }}</option>
                @endforeach

                   
                </select>
               
            </div>
            <div class="mb-3">
                <label for="pre_electricity">Cs điện cũ</label>
                <input type="number" name="pre_electricity" class="form-control" id="input1" value="{{ $electricity_usage->pre_electricity }}">
                @error('pre_electricity')
                <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
            </div>
            
            <div class="mb-3">
                <label for="current_electricity">Cs điện mới</label>
                <input type="number" name="current_electricity" class="form-control" id="input2" value={{$electricity_usage->current_electricity}}>
                @error('current_electricity')
                <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
            </div>
           
            <div class="mb-3">
                <label for="used_electricity">Điện sử dụng</label>
                <input type="number" name="used_electricity" class="form-control" id="result" readonly value="{{ $electricity_usage->used_electricity }}">
                  {{-- <p id="result"></p> --}}
            </div>
           
            <div class="mb-3">
                <label for="date_time">Date_time</label>
                <input type="date" name="date_time" class="form-control" id="" value="{{ $electricity_usage->date_time }}">
                @error('date_time')
                <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
            </div>
           
            
            
            <a href="{{ route('electric.index') }}" class="btn btn-warning ">Back</a>
            <button type="submit" class="btn btn-success ">Submit</button>
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