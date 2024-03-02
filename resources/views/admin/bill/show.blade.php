@extends('layouts.admin.layout')
@section('content')
<h1>Chi tiết hóa đơn</h1>
<hr>
<div class="bg-light">
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Phòng</th>
                <th>Ngày Tháng</th>
                <th>Số nước cũ</th>
                <th>Số nước mới</th>
                <th>Giá nước</th>
                 <th>Số điện cũ</th>
                <th>Số điện mới</th>
                <th>Giá điện</th>
                <th>Tổng giá dịch vụ</th>
                <th>Tiền phòng</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($bill_details as $item)

            <tr>
                <td>{{ $item->room_name }}</td>
                <td>{{ $item->date_start }}</td>
                <td>{{ $item->pre_water }}</td>
                <td>{{ $item->current_water }}</td>
                <td>{{ $item->water_price }}</td>
                <td>{{ $item->pre_electricity }}</td>
                <td>{{ $item->current_electricity }}</td>
                <td>{{ $item->electricity_price }}</td>
                <td>{{ $item->total_price_service }}</td>
                <td>{{ $item->room_price }}</td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
    <a href="{{ route('bill.index') }}" class="btn btn-warning my-2">Trở về</a>
</div>

@endsection
