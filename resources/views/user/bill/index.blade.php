@extends('layouts.user.layout')
@section('content')
{{-- <h1>
    Quản lí hóa đơn</h1>
<hr>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Tên</th>
                <th>Tên phòng</th>
                <th>Gía phòng</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Số nước cũ</th>
                <th>Số nước mới</th>
                <th>Gía nước</th>
                <th>Số điện cũ</th>
                <th>Số điện mới</th>
                <th>Gía điện</th>
                <th>total_price_service</th>
                <th>bill_id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($User_bill as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->room_name }}</td>
                <td>{{ $item->room_price }}</td>
                <td>{{ $item->date_start }}</td>
                <td>{{ $item->date_end }}</td>
                <td>{{ $item->pre_water }}</td>
                <td>{{ $item->current_water }}</td>
                <td>{{ $item->water_price }}</td>
                <td>{{ $item->pre_electricity }}</td>
                <td>{{ $item->current_electricity }}</td>
                <td>{{ $item->electricity_price }}</td>
                <td>{{ $item->total_price_service }}</td>
                <td>{{ $item->bill_id }}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table> --}}

    <h1>
        Quản lí hóa đơn</h1>
    <hr>
    <div class="bg-light">
        {{-- <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tính tiền
            </button>


        </div> --}}
        <div class="">
            @if (\Session::has('msc'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong> {{ \Session::get('msc') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (\Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{ \Session::get('msg') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tính tiền -->

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
                                        @error('date_time')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('bill.destroy', $item) }}" method="POST">
                                <a  href="{{ route('bill.generatePDF', $item) }}" class="btn btn-success"><i
                                        class="fa-solid fa-eye"></i></a>

                                {{-- <a href="{{ route('bill.edit', $item) }}" class="btn btn-primary"><i
                                        class="fa-solid fa-money-bill-1-wave"></i></a>
                               
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger button-action" type="submit"
                                        onclick="return confirm('Bạn có muốn xóa không')">
                                        <i class="fa-solid fa-trash-can"></i></button> --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $bills->links() }}
        </div>
@endsection