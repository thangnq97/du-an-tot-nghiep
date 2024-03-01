@extends('layouts.admin.layout')
@section('content')

<div class="d-flex justify-content-between align-items-center ">
    <h1 class="">Quản lí nước</h1>
</div>
<hr>
<div class="bg-light">
    <div class="m-3">
        <p class="fs-3 fw-bold mx-auto text-danger">Lưu ý:</p>
        <p>- Bạn phải gán dịch vụ thuộc loại nước cho khách thuê trước thì phần chỉ số này mới được tính cho phòng đó khi tính tiền.</p>
        <p>- Đối với lần đầu tiên sử dụng phần mềm bạn sẽ phải nhập chỉ số cũ và mới cho tháng sử dụng đầu tiên, các tháng tiếp theo phần mềm sẽ tự động lấy chỉ số mới tháng trước làm chỉ số cũ tháng sau.</p>
    </div>

    <div class="d-flex justify-content-end m-2">
        <a href="{{ route('waters.create') }}" class="btn  btn-primary ">
            <div>Thêm số nước</div>
        </a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Phòng</th>
                <th>Cs nước cũ</th>
                <th>Cs nước mới</th>
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
                    <a href="{{ route('waters.edit',$item->id) }}" class="btn  btn-success"><i class="fa-regular fa-pen-to-square"></i></a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data -> links() }}
</div>

@endsection
