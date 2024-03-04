@extends('layouts.admin.layout')
@section('content')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin</h6>
        </div>
        <br>
        <div class="card-body">
<form action="{{ route('interiors.update', ['interior' => $interior->id]) }}" method="POST" enctype="multipart/form-data">

@csrf
@method('PUT')
<label for="name">Tên nội thất</label>
<p></p>
<input type="text" name="name" id="name" class="form-control " value="{{ $interior->name }}">



<br><br>
<button type="submit" class="btn btn-info ">Sửa </button>
<a href="{{ route('interiors.index') }}" class="btn btn-danger m-3">Danh sách</a>
</form>
</div>
<br>


@endsection
