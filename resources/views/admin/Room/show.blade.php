@extends('layouts.admin.layout')
@section('content')
    <a href="{{ route('room.index') }}" class="btn btn-danger my-3">Trở về</a>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Thành viên</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Dịch vụ</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                role="tab" aria-controls="contact" aria-selected="false">Hợp Đồng</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="action-room">
                <a href="{{ route('room.create_service', ['room' => $room->id]) }}" class="btn btn-primary my-3">Thêm dịch
                    vụ</a>
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
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
    </div>
@endsection
<script></script>
