@extends('layouts.admin.layout')
@section('content')


<form action="{{ route('interiors.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label for="name">name</label>
<input type="text" name="name" id="name" class="form-control ">

<label for="price" class="form-label">Giá </label>
<input type="number" class="form-control" id="price" name="price">

<label>image</label>
<input type="file" class="form-control" placeholder="image" name="image">


<br><br>
<button type="submit" class="btn btn-info ">thêm </button>
</form>
<br>
<a href="{{ route('interiors.index') }}" class="btn btn-danger ">danh sách</a>

@endsection