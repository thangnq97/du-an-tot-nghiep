@extends('layouts.admin.layout')
@section('content')
    <form action="" class="bg-light px-3 py-3">
        <div class="d-flex justify-content-between align-items-center ">
            <h1 class=""> Chỉ số điện</h1>
            <div class="">
                <button class="btn btn-warning m-1 "> <i class="fa-solid fa-magnifying-glass text-white "></i>  Xem</button>
                <button class="btn btn-success  m-1 "> <i class="fa-solid fa-check text-white"></i> Lưu</button>
                <button class="btn btn-primary  m-1 "> <i class="fa-regular fa-file-excel text-white"></i> Xuất file excel</button>
            </div>
        </div>
        <div class="form-group mt-3 d-flex px-3 d-flex justify-content-between align-items-center">
            <div class="d-flex px-3">
                <label for="" class="fw-bold">Tháng/năm</label>
                <div class="px-3 ">
                    <input type="date" class="form-control ">
                </div>
            </div>
            <div class="d-flex d-flex px-3">
                <label for="" class="fw-bold">Trạng thái phòng</label>
                <div class="px-3 ">
                    <select name="period" id="period" class="form-select mx-3" aria-label="Default select example" >
                        <option selected>Tất cả</option>
                        <option value="1">Tầng 1</option>
                        <option value="2">Tầng 2</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <p class="fs-3 fw-bold mx-auto">Lưu ý:</p>
            <p>- Bạn phải gán dịch vụ thuộc loại điện cho khách thuê trước thì phần chỉ số này mới được tính cho phòng đó khi tính tiền.</p>
            <p>- Đối với lần đầu tiên sử dụng phần mềm bạn sẽ phải nhập chỉ số cũ và mới cho tháng sử dụng đầu tiên, các tháng tiếp theo phần mềm sẽ tự động lấy chỉ số mới tháng trước làm chỉ số cũ tháng sau.</p>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-2 ">
            <input type="checkbox">
            <label for="" class="text-danger fw-bold fs-4">Cảnh báo chỉ số điện cũ lớn hơn chỉ số điện mới</label>
        </div>
        <a href="{{ route('waters.create') }}" class="btn  btn-success">Thêm</a>
        <table class="table table-striped">
           <thead>
                <tr>
                    <th>Phòng</th>
                    <th>Cs điện cũ</th>
                    <th>Cs điện mới</th>
                    <th>Sử Dụng</th>
                    <th>Ngày tháng năm</th>
                </tr>
           </thead>
           <tbody>
            @foreach ($data as $item)

                <tr>
                    <td>{{ $item->room->name }}</td>
                    <td>{{ $item->pre_water }}</td>
                    <td>{{ $item->current_water }}</td>
                    <td>{{ $item->used_water }}</td>
                    <td>{{ $item->date_time }}</td>
                    <td>

                        <a href="{{ route('waters.edit',$item->id) }}" class="btn  btn-success">Sửa</a>
                    </td>
                </tr>
                @endforeach
           </tbody>
        </table>
        {{ $data -> links() }}
    </form>
@endsection
