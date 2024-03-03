@extends('layouts.admin.layout')
@section('content')
<h1>chi tiết</h1>

<a href="{{ route('Roominterior.create') }}" class="btn btn-info ">thêm</a>

<table class="table">
<thead>
    <tr>
        <th>interior_name</th>
        <th>room_name</th>
        <th>quantity</th>
        <th>status</th>
        
       
        <th>action</th>
        
    </tr>
</thead>
<tbody>
    @foreach ($data as $item)
    {{-- @dd($item->toArray()) --}}

    <tr>
        
        <td>{{ $item->interior->name }}</td>
        <td>{{ $item->room->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->status }}</td>
        
        
      
        <td>
            <form action="" method="POST">
                <a href="" class="btn btn-success button-action "><i class="fa-regular fa-pen-to-square"></i></a>
                
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