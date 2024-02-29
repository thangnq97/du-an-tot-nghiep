@extends('layouts.admin.layout')
@section('content')
        <a href="{{ route('bills.create') }}" class="btn  btn-success">Tính tiền</a>
        <table class="table table-striped">
           <thead>
                <tr>
                    <th>Phòng</th>
                    <th>Tổng tiền dịch vụ</th>
                    <th>Tổng tiền</th>
                    <th>Số tiền đã trả</th>
                    <th>Còn thiếu</th>
                    <th>Trạng thái</th>
                    <th></th>
                    
                    
                </tr>
           </thead>
           <tbody>
            @foreach ($data as $item)

                <tr>
                    <td>{{ $item->room->name }}</td>
                    <td>{{ $item->total_price_service }}</td>
                    <td>{{ $item->total_price }}</td>
                    <td>{{ $item->remaining_amount }}</td>
                    <td>{{ $item->paid_amount }}</td>
                    <td>{{ $item->is_paid }}</td>
                    
                    <td>
                        <a href="{{ route('bills.show',$item->id) }}" class="btn  btn-success">Chi tiết</a>
                                             
                    </td>
                </tr>
                @endforeach
           </tbody>
        </table>
        {{ $data -> links() }}
    </form>
@endsection
