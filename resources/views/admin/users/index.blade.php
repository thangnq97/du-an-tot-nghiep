@extends('layouts.admin.layout')
@section('content')
    <h1>Quản lí dịch vụ</h1>
    <hr>
    <div class="action-room">
        <a href="{{ route('users.create') }}" class="btn btn-info ">thêm</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">name</th>
                {{-- <th scope="col">Loại dịch vụ</th> --}}
                <th scope="col">email</th>
                <th scope="col">phone</th>
                
                <th scope="col">cccd</th>
                <th scope="col">address</th>      
                <th scope="col">role_id</th>   
                <th scope="col">room_id</th>        
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $t )
            <tr>
                
                <td>{{ $t->name }}</td>
                <td>{{ $t->email }}</td>
                <td>{{ $t->phone }}</td>
           
                <td>{{ $t->cccd }}</td>
                <td>{{ $t->address }}</td>
                <td>{{ $t->role_id }}</td>
                <td>{{ $t->room_id }}</td>
                <td>
                    
                   
                    <form action="" method="POST">
                        <a href="" class="btn btn-success button-action "><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="" class="btn btn-primary button-action"><i class="bi bi-eye-fill"></i></a>
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
<script></script>
