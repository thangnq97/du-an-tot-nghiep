@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif

<h1>Danh Sách Nội Thất</h1>

<div class="bg-light ms-auto  ">
<div class="action-room me-3">
    <a href="{{ route('interiors.create') }}" class="btn btn-primary mx-2 mt-3 ">Thêm nội thất</a>   
    <a href="{{ route('Roominterior.index') }}" class="btn btn-info mt-3 me">Chi tiết</a>
</div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Tên nội thất</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Số lượng còn lại</th>
                <th scope="col">Hoạt động</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($interiors as $e)

            <tr>
                <td>{{ $e->id }}</td>
                <td>{{ $e->name }}</td>
                <td>{{ $e->quantitys }}</td>
                <td>{{ $e->remainingQuantity }}</td>
                <td>
                    <div class="action-button">
                        <form action="{{ route('interiors.destroy',$e) }}" method="POST">
                            <a href="{{ route('interiors.edit',['interior'=> $e->id]) }}" class="btn btn-success button-action  "><i class="fa-regular fa-pen-to-square"></i></a>

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger button-action " onclick="return confirm('Bạn có muốn xóa không')"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                </td>
            </tr>

            @endforeach

        </tbody>
        
    </table>

</div>


@endsection