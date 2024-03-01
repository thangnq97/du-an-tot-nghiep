@extends('layouts.admin.layout')
@section('content')


<form action="{{ route('interiors.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label for="name">name</label>
<input type="text" name="name" id="name" class="form-control ">



<br><br>
<button type="submit" class="btn btn-info ">thêm </button>
</form>
<br>
<a href="{{ route('interiors.index') }}" class="btn btn-danger ">danh sách</a>

@endsection