@extends('layouts.admin.layout')
@section('content')
    <nav class="nav nav-pills gap-3">
        <a class=" nav-link @if ($sub_title == 'user') active @endif" aria-current="page"
            href="{{ route('admin.member.index', ['room' => $room->id]) }}">Thành viên</a>
        <a class="nav-link @if ($sub_title == 'service') active @endif"
            href="{{ route('room.show_service', ['room' => $room->id]) }}">Dịch vụ</a>
        <a class="nav-link @if ($sub_title == 'contract') active @endif " href="{{ route('admin.room.contract', ['room' => $room->id]) }}">Hợp đồng</a>
    </nav>
    <hr>
    @yield('room_content')
@endsection
