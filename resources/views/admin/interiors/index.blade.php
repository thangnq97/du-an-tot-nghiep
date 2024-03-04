@extends('layouts.admin.layout')
@section('content')
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
<h1>Danh Sách Nội Thất</h1>

<a href="{{ route('interiors.create') }}" class="btn btn-info ">  Thêm nội thất</a>
<a href="{{ route('Roominterior.index') }}" class="btn btn-primary m-3">Chi tiết</a>

<table class="table">
<thead>
    <tr>
        <th>id</th>
        <th>Tên nội thất</th>
        <th>Hoạt động</th>

    </tr>
</thead>
<tbody>
    @foreach ($data as $e)

    <tr>
        <td>{{ $e->id }}</td>
        <td>{{ $e->name }}</td>


        <td>


            <form action="{{ route('interiors.destroy',$e) }}" method="POST">
                <a href="{{ route('interiors.edit',['interior'=> $e->id]) }}" class="btn btn-success button-action  "><i class="fa-regular fa-pen-to-square"></i></a>

                @csrf
                @method('DELETE')
                <button class="btn btn-danger button-action " onclick="return confirm('bn cos muon xoa')"><i class="fa-solid fa-trash-can"></i></button>
            </form>

        </td>
    </tr>

    @endforeach
</tbody>



</table>




@endsection
