@extends('layouts.admin.layout')
@section('content')

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">name</label>
        <input type="text" name="name" id="name" class="form-control ">

        <label for="name">email</label>
<input type="text" name="email" id="email" class="form-control ">


<label for="name">phone</label>
<input type="text" name="phone" id="phone" class="form-control ">



<label for="name">cccd</label>
<input type="text" name="cccd" id="cccd" class="form-control ">

<label for="name">address</label>
<input type="text" name="address" id="address" class="form-control ">






        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
@endsection
