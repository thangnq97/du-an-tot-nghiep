@extends('admin.Room.layout');

@section('room_content')
    <div class="my-3">
        @if (session()->has('success'))
            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
                <strong>{{ session()->get('success') }}</strong>
            </div>
            
            <script>
                var alertList = document.querySelectorAll(".alert");
                alertList.forEach(function (alert) {
                    new bootstrap.Alert(alert);
                });
            </script>
            
        @endif
    </div>
    <div class="m-3 d-flex justify-content-end">
        <div>
            <a href="{{ route('admin.member.create', ['room'=>$room->id]) }}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>
    <table class="table table-tripped">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Căn cước công dân</th>
                <th>Địa chỉ</th>
                <th>
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->cccd }}</td>
                    <td>{{ $member->address }}</td>
                    <td>
                        <form action="{{ route('admin.member.destroy', ['room'=>$room->id, 'id'=>$member->id]) }}" method="POST" id="form">
                            <a href="{{ route('admin.member.edit', ['room'=>$room->id, 'id'=>$member->id]) }}" class="btn btn-success button-action">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
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
    </table>
@endsection