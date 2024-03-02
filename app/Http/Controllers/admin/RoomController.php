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
    public function create_People()
    {
        return view(self::PATHVIEW . __FUNCTION__);
    }
    public function store_People(Request $request)
    {   
        $id = $request->room_id;
        $room = Room::find($id);
        if($room->member_quantity + 1 > $room->member_maximum){
            return back()->with('msg', 'Phòng đã đầy');
        }
        $room->member_quantity += 1;
        $room->save();
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'member_maximum' => 'required',
                'price' => 'required',
                'width' => 'required',
                'height' => 'required',
            ],
            [
                'name.required' => 'Không được để trống tên',
                'name.max' => 'Không được nhập quá 255 kí tự',
                'member_maximum' => 'Không được để trống số lượng người giới hạn',
                'price.required' => 'Không được để trống giá phòng',
                'width.required' => 'Không được để trống chiều rộng',
                'height.required' => 'Không được để trống chiều dài'
            ]
        );
        $data = $request->all();
        Room::query()->create($data);
        return back()->with('msg', 'Thêm phòng thành công');
    }
    public function show_service(Room $room)
    {
        $title = "service";
        $room_service = Room_service::query()->where('room_id', '=', $room->id)->get();
        return view(self::PATHVIEW . __FUNCTION__, compact('room', 'room_service', 'title'));
    }
    public function show_user(Room $room)
    {
        $title = "user";
        return view(self::PATHVIEW . __FUNCTION__, compact('title', 'room'));
    }
    public function show_interior(Room $room)
    {
        $title = "interior";
        return view(self::PATHVIEW . __FUNCTION__, compact('title', 'room'));
    }
    public function create_service(Room $room)
    {
        $service = Service::all();
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
