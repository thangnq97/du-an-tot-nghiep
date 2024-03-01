@extends('layouts.admin.layout')
@section('content')
    <nav class="nav nav-pills gap-3">
        <a class=" nav-link @if ($title == 'user') active @endif" aria-current="page"
            href="{{ route('room.show_user', ['room' => $room->id]) }}">Thành viên</a>
        <a class="nav-link @if ($title == 'service') active @endif"
            href="{{ route('room.show_service', ['room' => $room->id]) }}">Dịch vụ</a>
        <a class="nav-link @if ($title == 'interior') active @endif " href="{{ route('room.show_interior', ['room' => $room->id]) }}">Cơ sở vật chất</a>
    </nav>
    <hr>
    @yield('room_content')
@endsection
