@extends('layouts.admin.layout')
@section('content')
<div>
    @if(\Session::has('msg'))
    <div class="alert alert-success   alert-dismissible fade show" role="alert">
        <strong> {{ \Session::get('msg') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('bill.store') }}" method="POST" enctype="multipart/form-data" class="row">
        @csrf

        @foreach ($water as $item)
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Phòng</label>
            <input class="form-control border-0" type="number" id="pre_water" name="pre_water" value="{{ $item->room_id }}" readonly>
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tiền phòng</label>
            @foreach ($price_room as $price)
            <input class="form-control border-0" type="number" id="price" name="price" value="{{ $price->price }}" readonly>
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số nước đã dùng</label>
            @foreach ($water as $water)
            <input class="form-control border-0" type="number" id="pre_water" name="current_water" @if(!isset($water->used_water) ) value="0" @else () value="{{ $water->used_water }}" @endif readonly>
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số điện đã dùng</label>
            @foreach ($electricity as $electricity)
            <input class="form-control border-0" type="number" id="pre_water" name="current_water"  @if(!isset($electricity->used_electricity) ) value="0" @else () value="{{ $electricity->used_electricity }}" @endif readonly>
            @endforeach
            </select>
        </div>
`
        @endforeach

</div>
<a class="btn btn-warning" href="{{ route('bill.index') }}">Trở về</a>
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
