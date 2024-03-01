@extends('layouts.admin.layout')

@section('content')
    <h2 class="my-4">Thông tin thành viên phòng {{ $room->name }}</h2>
    <table class="table table-tripped">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Căn cước công dân</th>
                <th>Địa chỉ</th>
                <th>
                    <a href="{{ route('admin.member.create', ['room'=>$room->id]) }}" class="btn btn-primary">Thêm mới</a>
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
                            <a href="{{ route('admin.member.edit', ['room'=>$room->id, 'id'=>$member->id]) }}" class="btn btn-success">Sửa</a>
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Xóa">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        const form = document.querySelector('#form');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const check = confirm('Bạn có chắc chắn muốn xóa không?');

            if(check) {
                form.submit();
            }
        })
    </script>
@endsection