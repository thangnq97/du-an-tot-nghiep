@extends('layouts.admin.layout')
@section('content')


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tạo mới</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('Roominterior.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <select name="interior_id" id="" class="form-control">
                                @foreach ($interiors as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
<br>
                        <div class="form-group">
                            <select name="room_id" id="" class="form-control">
                                @foreach ($rooms as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>quantity</label>
                            <input type="text" class="form-control" placeholder="quantity" name="quantity">
                        </div>
                        

                        <div class="form-group">
                            <label>status</label> <br>
                            <input type="text" class="form-control" placeholder="status" name="status">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
       
    @endsection
