@extends('layouts.admin.layout')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <h1>Quản lí dịch vụ</h1>
    <hr>
    <div class="bg-light">
    <div class="action-room">
        <a href="{{ route('service.create') }}" class="btn btn-primary m-2">Thêm dịch vụ</a>
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
                    <td class="text-danger">{{ number_format($query->price) }} VNĐ</td>
                    <td>{{ $query->method ? 'Số đồng hồ' : 'Số người' }}</td>
                    <td> 
                        <div class="action-button" >
                            <a href="{{ route('service.edit', $query) }}" class="btn btn-success button-action"><i
                                class="fa-regular fa-pen-to-square"></i></a>
                        <form action="{{ route('service.destroy', $query) }}" method="POST">
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
@endsection
<script></script>
