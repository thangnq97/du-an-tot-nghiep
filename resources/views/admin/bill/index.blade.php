@extends('layouts.admin.layout')
@section('content')
<div class="w-50">
{{-- <a href="{{ route('bill.create') }}" class="btn btn-success">Tính tiền</a> --}}
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Tính tiền
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center ">Bills</h2>
                <form action="{{ route('bill.demoShow') }}" method="POST" enctype="multipart/form-data" class="row">
                    @csrf
                    <div>


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phòng</label>
                            <select name="room_id" id="" class="form-control ">
                                @foreach ($room as $id => $name)
                                <option value="{{ $id }}">{{ $id }}--{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phòng</label>
                            <select name="date_time" id="" class="form-control ">
                                @foreach ($water as $date)
                                <option>{{ $date->date_time }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Understood</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
</div>

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
        @foreach ($bill as $item)

        <tr>
            <td>{{ $item->room->name }}</td>
            <td>{{ $item->total_price_service }}</td>
            <td>{{ $item->total_price }}</td>
            <td>{{ $item->remaining_amount }}</td>
            <td>{{ $item->paid_amount }}</td>
            <td>{{ $item->is_paid }}</td>

            <td>
                {{-- <a href="{{ route('bill.show',$item->id) }}" class="btn btn-success">Chi tiết</a> --}}

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $bill -> links() }}

</div>
@endsection
