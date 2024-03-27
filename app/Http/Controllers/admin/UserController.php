<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActiveMailAdmin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_UPLOAD = 'user';
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $room = Room::find($id);
        $title = 'Quản lí phòng';
        $sub_title = 'user';

        if(!$room) {
            return redirect()->route('admin.index');
        }

        $members = DB::table('users')->where('room_id', '=', $id)->where('is_active', '=', 1)->orderByDesc('id')->get();
        return view('admin.member.index', compact('members', 'room', 'sub_title', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $room = Room::find($id);
        $title = 'Quản lí phòng';
        $sub_title = 'user';

        if(!$room) {
            return redirect()->route('admin.index');
        }

        return view('admin.member.create', compact('room', 'title', 'sub_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $room = Room::find($id);

        if(!$room || $room->member_quantity >= $room->member_maximum) {
            return redirect()->back()->with('error', 'Phòng đã đầy');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'unique:users|required|email',
            'password' => 'required',
            'phone' => 'unique:users|required',
            'cccd' => 'unique:users|required',
            'address' => 'required',
        ],
        [
            'name.required' => 'Không được để trống tên',
            'name.max' => 'Độ dài không quá 255 kí tự',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Bạn nhập phải là địa chỉ email hợp lệ',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Không được để trống mật khẩu',
            'phone.required' => 'Không được để trống Số điện thoại',
            'phone.unique' => 'Số điện thoại này đã được sử dụng',
            'cccd.required' => 'Không được để trống chứng minh nhân dân',
            'cccd.unique' => 'Chứng minh nhân dân này đã được sử dụng',
            'address.required' => 'Không được để trống địa chỉ',
        ]);

        $token = strtoupper(Str::random(20));
        $request->merge(['token' => $token, 'password' => Hash::make($request->password)]);
        $user = User::create($request->all());
        $user->room_id = $id;
        $user->save();

        $room->member_quantity += 1;
        $room->save();

        $mailData = [
            'id' => $user->id,
            'name' => $user->name,
            'token' => $user->token
        ];
        Mail::to($user->email)->send(new ActiveMailAdmin($mailData));

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $room, string $id)
    {
        $room = Room::find($room);
        $user = User::find($id);
        $title = 'Quản lí phòng';
        $sub_title = 'user';

        if(!$room || !$user) {
            return redirect()->route('admin.index');
        }

        return view('admin.member.edit', compact('room', 'user', 'title', 'sub_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $room, string $id)
    {
        
        $room = Room::find($room);
        $user = User::find($id);

        if(!$room || !$user) {
            return redirect()->route('admin.index');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'unique:users|required|email',
            'password' => 'required',
            'phone' => 'unique:users|required',
            'cccd' => 'unique:users|required',
            'address' => 'required',
        ],
        [
            'name.required' => 'Không được để trống tên',
            'name.max' => 'Độ dài không quá 255 kí tự',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Bạn nhập phải là địa chỉ email hợp lệ',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Không được để trống mật khẩu',
            'phone.required' => 'Không được để trống Số điện thoại',
            'phone.unique' => 'Số điện thoại này đã được sử dụng',
            'cccd.required' => 'Không được để trống chứng minh nhân dân',
            'cccd.unique' => 'Chứng minh nhân dân này đã được sử dụng',
            'address.required' => 'Không được để trống địa chỉ',
        ]);


        if($request->email === $user->email) {
            $request->request->remove('email');
        }

        if($request->cccd === $user->cccd) {
            $request->request->remove('cccd');
        }

        if($request->phone === $user->phone) {
            $request->request->remove('phone');
        }

        $user->update($request->all());
        return redirect()->route('admin.member.index', ['room' => $room->id])->with('success', 'Sửa thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $room, string $id)
    {
        $room = Room::find($room);
        $user = User::find($id);

        if(!$room || !$user) {
            return redirect()->route('admin.index');
        }

        File::delete($user->avatar);
        $user->is_active = 0;
        $user->save();
        $room->member_quantity -= 1;
        $room->save();
        return redirect()->route('admin.member.index', ['room' => $room->id])->with('success', 'Xóa thành công');
    }
}
