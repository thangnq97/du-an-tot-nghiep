@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div class="action-room">
        <a href="{{ route('service.create') }}" class="btn btn-primary ">Thêm dịch vụ</a>
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
            @foreach ($data as $query)
                <tr>
                    {{-- <th scope="row">{{ $query->id }}</th> --}}
                    <td>{{ $query->name }}</td>
                    <td>{{ number_format($query->price) }}</td>
                    <td>{{ $query->method ? 'Số đồng hồ' : 'Số người' }}</td>
                    <td>
                        <a href="{{ route('service.edit', $query) }}" class="btn btn-success"><i
                                class="fa-regular fa-pen-to-square"></i></a>
                        <form action="{{ route('service.destroy', $query) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm ('Bạn có muốn xóa không')">
                                <i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
<script></script>
