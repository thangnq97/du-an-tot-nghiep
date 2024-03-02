@extends('layouts.admin.layout')
@section('content')
<h1>Quản lí hóa đơn</h1>
<hr>
<div class="bg-light">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Tính tiền
        </button>
    </div>
    <div class="">
        {{-- <a href="{{ route('bill.create') }}" class="btn btn-success">Tính tiền</a> --}}
        <!-- Button trigger modal -->


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
                        <form action="{{ route('bill.store') }}" method="POST" enctype="multipart/form-data" class="row">
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
                                     <input class="form-control " type="date" id="pre_water" name="date_time">
                                   
                                </div>

                                 <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" name="note"></textarea>
                                   
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Trở về</button>
                                <button type="submit" class="btn btn-success">Tính</button>
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
            @foreach ($bills as $item)

            <tr>
                <td>{{ $item->room->name }}</td>
                <td>{{ $item->total_price_service }}</td>
                <td>{{ $item->total_price }}</td>
                <td>{{ $item->paid_amount }}</td>
                <td>{{ $item->remaining_amount }}</td>
                <td>{{ $item->is_paid }}</td>

                <td>
                    <a href="{{ route('bill.show',$item->id)}}"   class="btn btn-success"><i class="fa-solid fa-eye"></i></a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bills -> links() }}
</div>

@endsection
