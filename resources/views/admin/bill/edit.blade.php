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
                <input type="date" class="form-control" id="exampleInputEmail1" disabled name="date_time" aria-describedby="emailHelp" value="{{ $bill->date_time }}">
                @error('date_time')
                    <div class="text-danger ">{{ $message }}</div>
                @enderror
                @if (\Session::has('date_time'))
                    <p class="text-danger"> {{ \Session::get('date_time') }}</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Số tiền</label>
                <input type="text" class="form-control"  id="pay_1" name="paid_amount" value="{{ number_format($bill->paid_amount) }}">
                @error('paid_amount')
                    <div class="text-danger ">{{ $message }}</div>
                @enderror
            </div>
            
            <div  hidden class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phương thức thanh toán</label>
                <input type="number" class="form-control"  id="exampleInputPassword1" name="payment_method_id">
            </div>

            <div>
            <button type="submit" class="btn btn-success">Thu</button>
            <a href="{{ route('bill.index') }}" class="btn btn-warning">Trở về</a>

            </div>

        </form>
    </div>
   
@endsection