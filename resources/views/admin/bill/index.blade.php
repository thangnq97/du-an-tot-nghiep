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
        @if (\Session::has('msc'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> {{ \Session::get('msg') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (\Session::has('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> {{ \Session::get('msg') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif



        <!-- Button trigger modal -->

        <!-- form thu tiền -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center ">Thu tiền</h2>
                        <form action="{{ route('bill.store') }}" method="POST" enctype="multipart/form-data"
                            class="row">
                            @method('PUT')
                            @csrf

                            <div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ngày/tháng</label>
                                    <input class="form-control " type="date" id="pre_water" name="date_time" value="">

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Số tiền</label>
                                    <input class="form-control " type="number" id="pre_water" name="date_time" value="">

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Trở về</button>
                                <button type="submit" class="btn btn-success">Thu</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center ">Tính tiền</h2>
                        <form action="{{ route('bill.store') }}" method="POST" enctype="multipart/form-data"
                            class="row">
                            @csrf
                            <div>


                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phòng</label>
                                    <select name="room_id" id="" class="form-control ">
                                        @foreach ($room as $id => $name)
                                        <option value="{{ $id }}">{{ $id }}--{{ $name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ngày/tháng</label>
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
                    <td>
                        @if ($item->is_paid == 1)
                        <p class="btn btn-success"><i class="fa-solid fa-money-bill-1-wave"></i></p>
                        @else
                        <p class="btn btn-danger"><i class="fa-solid fa-money-bill-1-wave"></i></p>
                        @endif</td>
    
                    <td>

                        <a href="{{ route('bill.generatePDF', $item) }}" class="btn btn-success"><i
                                class="fa-solid fa-eye"></i></a>

                        <a href="{{ route('bill.edit', $item) }}"  class="btn btn-primary"><i
                                class="fa-solid fa-money-bill-1-wave"></i></a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bills->links() }}
    </div>
    @endsection