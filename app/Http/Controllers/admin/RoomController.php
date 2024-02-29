<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Room_service;
use App\Models\Service;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    const PATHVIEW = "admin.room.";
    public function index()
    {
        $data = Room::query()->paginate();

        return view(self::PATHVIEW . __FUNCTION__, compact('data'));
    }
    public function create()
    {
        return view(self::PATHVIEW . __FUNCTION__);
    }
    public function createPeople()
    {
        return view(self::PATHVIEW . __FUNCTION__);
    }
    public function storePeople()
    {
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'member_maximum' => 'required',

        ]);
        $data = $request->all();
        Room::query()->create($data);
        return back()->with('msg', 'Thêm phòng thành công');
    }
    public function show(Room $room)
    {
        $room_service = Room_service::query()->where('room_id', '=', $room->id)->get();
        return view(self::PATHVIEW . __FUNCTION__, compact('room', 'room_service'));
    }
    public function create_service(Room $room)
    {
        $service = Service::all ();
        $service_id = Room_service::query()->where('room_id', '=', $room->id)->get();
        return view(self::PATHVIEW . __FUNCTION__, compact('room', 'service', 'service_id'));
    }
    public function store_service(Request $request, Room $room)
    {
        $data = ['room_id' => $room->id, 'service_id' => $request->service_id];
        Room_service::query()->create($data);
        return back()->with('msg', 'Thêm thành công');
    }

    public function edit(Room $room)
    {
        return view(self::PATHVIEW . __FUNCTION__, compact('room'));
    }
    public function update(Request $request, Room $room)
    {
        $data = $request->all();
        $room->update($data);
        return back()->with('msg', 'Sửa phòng thành công');
    }
    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('msg', 'Xóa phòng thành công');
    }
    public function delete_service(string $id)
    {
        $room_service = Room_service::find($id);
        $room_service->delete();
        return back()->with('msg', 'Xóa thành công');
    }
}
