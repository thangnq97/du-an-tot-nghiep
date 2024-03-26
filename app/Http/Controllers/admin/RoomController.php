<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
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
    public function edit(Room $room)
    {
        return view(self::PATHVIEW . __FUNCTION__, compact('room'));
    }
    public function update(Request $request, Room $room){
        $data = $request->all();
        $room->update($data);
        return back()->with('msg', 'Sửa phòng thành công');
    }
    public function destroy(Room $room){
        $room->delete();
        return back()->with('msg', 'Xóa phòng thành công');
    }
}
