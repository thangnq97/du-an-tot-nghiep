@extends('admin.Room.layout')

@section('room_content')
    @include('layouts.admin.alert')
    <div class="m-3 d-flex justify-content-end">
        @if ( count($contract) )
            <a href="{{ route('admin.create.extension.contract', ['room' => $room->id]) }}" class="btn btn-success">Phụ lục</a>
        @else
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId1">
                Tạo mới
            </button>
        @endif
    </div>
    @if (count($contract))
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
    @endif
    @if (count($contract_extension))
        <hr style="margin-top: 100px"> 
        <h4 class="" style="">Phụ lục hợp đồng</h4>
        <table class="table table-tripped my-4">
            <thead>
                <tr>
                    <th>Ngày tạo</th>
                    <th>Thời hạn</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contract_extension as $item)
                    <tr>
                        <td>{{ $item->started_at }}</td>
                        <td>{{ $item->month_quantity }}</td>
                        <td>
                            <a href="{{ route('admin.extension.contract.view', ['room'=>$room->id, 'extension_contract'=>$item->id]) }}" class="btn btn-success button-action"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Modal trigger button -->


    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId1" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.contract.store', ['room'=>$room->id]) }}" method="POST" id="form1">
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
        const myModal1 = new bootstrap.Modal(
            document.getElementById("modalId1"),
            options,
        );
    </script>
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
