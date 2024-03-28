@extends('admin.room.layout')
@section('room_content')
    @if (Session::has('msg'))
        <div class="alert alert-danger">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div class="action-room action-button">
        <a href="{{ route('room.create_service', ['room' => $room->id]) }}" class="btn btn-primary my-3">Thêm dịch
            vụ</a>
        <a href="{{ route('room.index') }}" class="btn btn-warning my-3">Trở về</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Tên</th>
                {{-- <th scope="col">Loại dịch vụ</th> --}}
                <th scope="col">Đơn giá</th>
                <th scope="col">Phương thức tính</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($room_service as $query)
                <tr>
                    {{-- <th scope="row">{{ $query->id }}</th> --}}
                    <td>{{ $query->service->name }}</td>
                    <td>{{ number_format($query->service->price) }}</td>
                    <td>{{ $query->service->method ? 'Số đồng hồ' : 'Số người' }}</td>
                    <td>
                        <div class="action-button">
                            {{-- <a href="{{ route('service.edit', $query) }}" class="btn btn-success button-action"><i
                                            class="fa-regular fa-pen-to-square"></i></a> --}}
                            <form action="{{ route('room.delete_service', $query) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger button-action"
                                    onclick="return confirm ('Bạn có muốn xóa không')">
                                    <i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
<script></script>
