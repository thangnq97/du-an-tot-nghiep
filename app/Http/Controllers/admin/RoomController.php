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
        $title = 'Quản lí phòng';

        return view(self::PATHVIEW . __FUNCTION__, compact('data', 'title'));
    }
    public function create()
    {
        $title = 'Quản lí phòng';
        return view(self::PATHVIEW . __FUNCTION__, compact('title'));
    }
    public function create_People()
    {
        $title = 'Quản lí phòng';
        return view(self::PATHVIEW . __FUNCTION__, compact('title'));
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
        $sub_title = "service";
        $title = 'Quản lí phòng';
        $room_service = Room_service::query()->where('room_id', '=', $room->id)->get();
        return view(self::PATHVIEW . __FUNCTION__, compact('room', 'room_service', 'title', 'sub_title'));
    }
    public function show_user(Room $room)
    {
        $sub_title = "user";
        $title = 'Quản lí phòng';
        return view(self::PATHVIEW . __FUNCTION__, compact('title', 'room', 'sub_title'));
    }
    public function show_interior(Room $room)
    {
        $sub_title = "interior";
        $title = 'Quản lí phòng';
        return view(self::PATHVIEW . __FUNCTION__, compact('title', 'room', 'sub_title'));
    }
    public function create_service(Room $room)
    {
        $title = 'Quản lí phòng';
        $service = Service::all();
        $service_id = Room_service::query()->where('room_id', '=', $room->id)->get();
        return view(self::PATHVIEW . __FUNCTION__, compact('room', 'service', 'service_id', 'title', 'sub_title'));
    }
    public function store_service(Request $request, Room $room)
    {
        $data = ['room_id' => $room->id, 'service_id' => $request->service_id];
        Room_service::query()->create($data);
        return back()->with('msg', 'Thêm thành công');
    }

    public function edit(Room $room)
    {
        $title = 'Quản lí phòng';
        return view(self::PATHVIEW . __FUNCTION__, compact('room', 'title'));
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
