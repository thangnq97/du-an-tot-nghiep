@extends('layouts.admin.layout')
@section('content')
    <div>
        @if (\Session::has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ \Session::get('msg') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (\Session::has('msc'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ \Session::get('msc') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="{{ route('bill.update',$bill) }}" method="POST" enctype="multipart/form-data" class="row">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ngày/tháng</label>
                <input type="date" class="form-control" id="exampleInputEmail1" name="date_time" aria-describedby="emailHelp" value="{{ $bill->date_time }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Số tiền</label>
                <input type="text" class="form-control"  id="pay_1" name="paid_amount" value="{{ $bill->paid_amount }}">
            </div>

            <div hidden class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tổng tiền</label>
                <input type="text" class="form-control"  id="pay2" name="total_price" value="{{ $bill->total_price }}">
            </div>

            <div hidden class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Số tiền còn thiếu</label>
                <input type="text" class="form-control"  id="result" name="remaining_amount" value="{{ $bill->remaining_amount }}">
            </div>

            <div  hidden class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Trạng thái</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="is_paid" value="{{ $bill->is_paid }}" >
            </div>
            

            <div  hidden class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tổng tiền dịch vụ</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="total_price_service" value="{{ $bill->total_price_service }}">
            </div>

            <div  hidden class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phòng</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="room_id" value="{{ $bill->room_id }}">
            </div>

            <div>
            <button type="submit" class="btn btn-success">Thu</button>
            <a href="{{ route('bill.index') }}" class="btn btn-warning">Trở về</a>

            </div>

        </form>
    </div>
   
@endsection