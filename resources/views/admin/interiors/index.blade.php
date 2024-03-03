@extends('layouts.admin.layout')
@section('content')
<h1>danh sach</h1>

<a href="{{ route('interiors.create') }}" class="btn btn-info ">thêm</a>
<a href="{{ route('Roominterior.index') }}" class="btn btn-primary button-action"><i class="bi bi-eye-fill"></i></a>
<table class="table">
<thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>image</th>
        <th>action</th>
        
    </tr>
</thead>
<tbody>
    @foreach ($data as $e)

    <tr>
        <td>{{ $e->id }}</td>
        <td>{{ $e->name }}</td>
        <td>{{ $e->price }}</td>
        <td>
            <img src="{{ $e->image }}" alt="" width="100px" height="100px">
        </td>
       
        <td>
            
           
            <form action="{{ route('interiors.destroy',$e) }}" method="POST">
                <a href="{{ route('interiors.edit',['interior'=> $e->id]) }}" class="btn btn-success button-action "><i class="fa-regular fa-pen-to-square"></i></a>
                
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