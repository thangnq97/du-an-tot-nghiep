<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Room_service;
use App\Models\Service;
use App\Models\User;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    //
    const PATH_VIEW = "admin.room.";
    const PATH_UPLOAD = 'user';
    public function index()
    {
        $data = Room::query()->paginate();
        $title = 'Quản lí phòng';

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'title'));
    }
    public function create()
    {
        $title = 'Quản lí phòng';
        return view(self::PATH_VIEW . __FUNCTION__, compact('title'));
    }
    public function create_People(Room $room)
    {
        $title = 'Quản lí phòng';
        return view(self::PATH_VIEW . __FUNCTION__, compact('title', 'room'));
    }
    public function store_People(Request $request, string $id)
    {
        $room = Room::find($id);
        if (!$room) {
            return redirect()->route('admin.index');
        }

        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'unique:users|required|email',
                'password' => 'required',
                'phone' => 'unique:users|required',
                'cccd' => 'unique:users|required',
                'address' => 'required',
                'avatar' => 'extensions:jpg,png,JPEG|max:1024',
            ],
            [
                'name.required' => 'Không được để trống tên',
                'name.max' => 'độ dài ko quá 255 kí tự',
                'email.required' => 'Không được để trống email',
                'email.email' => 'Bạn nhập phải là địa chỉ email hợp lệ',
                'email.unique' => 'Email này đã được sử dụng',
                'password.required' => 'Không được để trống mật khẩu',
                'phone.required' => 'Không được để trống Số điện thoại',
                'phone.unique' => 'Số điện thoại này đã được sử dụng',
                'cccd.required' => 'Không được để trống chứng minh nhân dân',
                'cccd.unique' => 'Chứng minh nhân dân này đã được sử dụng',
                'address.required' => 'Không được để trống địa chỉ',
                'avatar.extensions' => 'Bạn chọn tệp không phải là ảnh'
            ]
        );

        if ($room->member_quantity + 1 > $room->member_maximum) {
            return back()->with('err', 'Phòng đã đầy');
        }
        $user = $request->except('avatar');
        $user = User::create($request->all());
        $user->room_id = $id;
        $user->save();
        if ($request->hasFile('avatar')) {
            $user['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
        }
        $room->member_quantity += 1;
        $room->save();
        return redirect()->back()->with('msg', 'Thêm mới thành công');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'member_maximum' => 'required',
                'price' => 'required',
                'width' => 'required',
                'length' => 'required',
            ],
            [
                'name.required' => 'Không được để trống tên',
                'name.max' => 'Không được nhập quá 255 kí tự',
                'member_maximum' => 'Không được để trống số lượng người giới hạn',
                'price.required' => 'Không được để trống giá phòng',
                'width.required' => 'Không được để trống chiều rộng',
                'length.required' => 'Không được để trống chiều dài'
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
        return view(self::PATH_VIEW . __FUNCTION__, compact('room', 'room_service', 'title', 'sub_title'));
    }
    public function show_user(Room $room)
    {
        $sub_title = "user";
        $title = 'Quản lí phòng';
        return view(self::PATH_VIEW . __FUNCTION__, compact('title', 'room', 'sub_title'));
    }
    public function show_interior(Room $room)
    {
        $sub_title = "interior";
        $title = 'Quản lí phòng';
        return view(self::PATH_VIEW . __FUNCTION__, compact('title', 'room', 'sub_title'));
    }
    public function create_service(Room $room)
    {
        $title = 'Quản lí phòng';
        $service = Service::all();
        $service_id = Room_service::query()->where('room_id', '=', $room->id)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('room', 'service', 'service_id', 'title', 'sub_title'));
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
        return view(self::PATH_VIEW . __FUNCTION__, compact('room', 'title'));
    }
    public function update(Request $request, Room $room)
    {
        $data = $request->all();
        $room->update($data);
        return redirect()->route('room.index');
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
