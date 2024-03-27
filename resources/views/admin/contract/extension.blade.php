@extends('admin.Room.layout');

@section('room_content')
    <div>
        <h3 class="my-4 text-center">Phụ lục hợp đồng</h3>
        <form action="{{ route('admin.extension.contract.store', ['room'=>$room->id]) }}" class="container w-50" method="POST">
            @csrf
            <div class="my-3">
                <label for="" class="form-label">Ngày tạo</label>
                <input type="date" class="form-control" name="started_at" value="{{ old('started_at') }}">
                @error('started_at')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="my-3">
                <label for="" class="form-label">Thời hạn</label>
                <input type="number" class="form-control" name="month_quantity" value="{{ old('month_quantity') }}">
                @error('month_quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @if (session()->has('month_quantity'))
                    <small class="text-danger">{{ session()->get('month_quantity') }}</small>
                @endif
            </div>
            <div class="my-3">
                <label for="" class="form-label">Nội dung</label>
                <textarea id="editor" cols="30" rows="18" class="" name="description" style="height: 400px">
                    {{ old('description') }}
                </textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="my-3">
                <input type="submit" class="btn btn-primary" value="Tạo">
                <a href="{{ route('admin.room.contract', ['room'=>$room->id]) }}" class="btn btn-warning mx-1">Quay lại</a>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), 
                {
                    ckfinder:
                        {
                            uploadUrl:"{{ route('admin.extension.contract.store', ['_token' => csrf_token(), 'room'=>$room->id]) }}"
                        }
                }
            )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection