@extends('layouts.admin.layout')
@section('content')
    <h1>
        Quản lí hóa đơn</h1>
    <hr>
    <div class="bg-light">
        <div class="d-flex justify-content-end">
            <button type="button" class="close btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tính tiền
            </button>


        </div>
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
                                class="row" id="form1">
                                @csrf
                                <div>


                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Phòng</label>
                                        <select name="room_id" id="started_at" class="form-control ">
                                            <option value="" selected disabled>--Tên phòng--</option>
                                            @foreach ($room as $id => $name)
                                                <option value="{{ $id }}">{{ $id }}--{{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error" style="display: none">Phòng không được để trống</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Ngày/tháng</label>
                                        <input class="form-control " type="date" id="month_quantity" name="date_time">
                                        <small class="text-danger error" style="display: none">Ngày/tháng không được để trống</small>
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

            {{-- Lọc dữ liệu --}}
            <form action="{{ route('bill.index') }}" method="GET">
                @csrf <!-- Thêm token CSRF để bảo vệ biểu mẫu -->
            
                <div class="row align-items-center">
                    <div class="col-md-4 mb-2">
                        <select class="form-select" name="room" id="room1"> <!-- Đặt tên cho trường select -->
                            <option selected disabled>--Chọn phòng--</option>
                            @foreach ($room as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                  
                    <div class="col-md-4 mb-2">
                        <select class="form-select" name="date_time" id="room2"> <!-- Đặt tên cho trường select -->
                            <option selected disabled>--Ngày/tháng--</option>
                            @foreach ($date_bill as $bill_search)
                                <option>{{ $bill_search->date_time }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-4 mb-2">
                        <button type="submit" class="btn btn-success">Tìm kiếm</button>
                    </div>
                </div>
            </form>

            {{-- Hiển thị danh sách bill --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Phòng</th>
                        <th>Tổng tiền dịch vụ</th>
                        <th>Tổng tiền</th>
                        <th>Số tiền đã trả</th>
                        <th>Còn thiếu</th>
                        <th>Ghi chú</th>
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
                            <td>{{ $item->note }}</td>
                            <td>
                                @if ($item->is_paid == 1)
                                    <p class="btn btn-success"><i class="fa-solid fa-money-bill-1-wave"></i></p>
                                @else
                                    <p class="btn btn-danger"><i class="fa-solid fa-money-bill-1-wave"></i></p>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('bill.destroy', $item) }}" method="POST">
                                    <a href="{{ route('bill.generatePDF', $item) }}" class="btn btn-success"><i
                                            class="fa-solid fa-eye"></i></a>

                                    <a href="{{ route('bill.edit', $item) }}" class="btn btn-primary"><i
                                            class="fa-solid fa-money-bill-1-wave"></i></a>

                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger button-action" type="submit"
                                        onclick="return confirm('Bạn có muốn xóa không')">
                                        <i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $bills->links() }}
        </div>

        <script>
            const started_at = document.getElementById("started_at");
            const month_quantity = document.getElementById("month_quantity");
            const form = document.getElementById("form1");
            const close = document.querySelectorAll(".close");
    
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                let check = false;
    
                if(!started_at.value) {
                    started_at.parentElement.querySelector('.error').style.display = 'block';
                    check = false;
                }else {
                    started_at.parentElement.querySelector('.error').style.display = 'none';
                    check = true;
                }
    
                if(!month_quantity.value.trim()) {
                    month_quantity.parentElement.querySelector('.error').style.display = 'block';
                    check = false;
                }else {
                    month_quantity.parentElement.querySelector('.error').style.display = 'none';
                    check = true;
                }
    
                if(check) {
                    form.submit();
                }
            })
    
            month_quantity.addEventListener('change', (e) => {
                if(e.target.value <= 0) {
                    e.target.value = 1;
                }
            })
    
            close.forEach(element => {
                element.addEventListener('click', (e) => {
                    started_at.parentElement.querySelector('.error').style.display = 'none';
                    month_quantity.parentElement.querySelector('.error').style.display = 'none';
                })
            })
        </script>
    @endsection
