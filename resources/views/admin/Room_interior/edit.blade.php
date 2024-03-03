@extends('layouts.admin.layout')
@section('content')
<form action="{{ route('interiors.update', ['interior' => $interior->id]) }}" method="POST" enctype="multipart/form-data">

@csrf
@method('PUT')
<label for="name">name</label>
<input type="text" name="name" id="name" class="form-control " value="{{ $interior->name }}">

<label for="name">price</label>
<input type="text" name="price" id="price" class="form-control " value="{{ $interior->price }}">

<label for="image">image</label> <br>
<input type="file" name="image"> <br>


<br><br>
<button type="submit" class="btn btn-info ">sửa </button>
</form>
<br>
<a href="{{ route('interiors.index') }}" class="btn btn-danger ">danh sách</a>

@endsection