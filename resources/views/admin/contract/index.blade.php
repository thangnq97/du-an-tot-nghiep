@extends('admin.Room.layout');

@section('room_content')
    <div class="my-3">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ session()->get('success') }}</strong>
            </div>

            <script>
                var alertList = document.querySelectorAll(".alert");
                alertList.forEach(function(alert) {
                    new bootstrap.Alert(alert);
                });
            </script>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ session()->get('error') }}</strong>
            </div>

            <script>
                var alertList = document.querySelectorAll(".alert");
                alertList.forEach(function(alert) {
                    new bootstrap.Alert(alert);
                });
            </script>
        @endif
    </div>
    <div class="m-3 d-flex justify-content-end">
        @if ( count($contract) )
            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
                Phụ lục
            </button>
        @else
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
                Tạo mới
            </button>
        @endif
    </div>
    <table class="table table-tripped">
        <thead>
            <tr>
                <th>Ngày tạo hợp đồng</th>
                <th>Thời hạn hợp đồng(tháng)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contract as $item)
                <tr>
                    <td>{{ $item->started_at }}</td>
                    <td>{{ $item->month_quantity }}</td>
                    <td>
                        <form action="" method="POST">
                            <a href="{{ route('admin.contract.view', ['room'=>$room->id, 'contract'=>$item->id]) }}" class="btn btn-success button-action"><i class="fa-solid fa-eye"></i></a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger button-action" type="submit"
                                onclick="return confirm('Bạn có muốn xóa không?')">
                                <i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tbody>
        </tbody>
    </table>
    @if (count($))
        
    @endif

    <!-- Modal trigger button -->


    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.contract.store', ['room'=>$room->id]) }}" method="POST" id="form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Tạo mới hợp đồng, phòng {{ $room->name }}
                        </h5>
                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-2">
                            <label for="" class="form-label">Ngày tạo hợp đồng</label>
                            <input type="date" class="form-control" name="started_at" id="started_at">
                            <small class="text-danger error" style="display: none">Ngày tạo hợp đồng không được để trống</small>
                        </div>
                        <div class="my-2">
                            <label for="" class="form-label">Thời hạn hợp đồng</label>
                            <input type="number" class="form-control" name="month_quantity" id="month_quantity">
                            <small class="text-danger error" style="display: none">Thời hạn hợp đồng không được để trống</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="close btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(
            document.getElementById("modalId"),
            options,
        );
    </script>
    <script>
        const started_at = document.getElementById("started_at");
        const month_quantity = document.getElementById("month_quantity");
        const form = document.getElementById("form");
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
