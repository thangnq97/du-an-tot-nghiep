<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $room = Room::find($id);

        if(!$room) {
            return redirect()->route('admin.index');
        }

        $members = DB::table('users')->where('room_id', '=', $id)->orderByDesc('id')->get();
        return view('admin.member.index', compact('members', 'room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $room = Room::find($id);

        if(!$room) {
            return redirect()->route('admin.index');
        }

        return view('admin.member.create', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $room = Room::find($id);

        if(!$room) {
            return redirect()->route('admin.index');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'cccd' => 'required',
            'address' => 'required',
        ]);

        $user = User::create($request->all());
        $user->room_id = $id;
        $user->save();
        return redirect()->back()->with('message', 'Thêm mới thành công');
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

        if(!$room || !$user) {
            return redirect()->route('admin.index');
        }

        return view('admin.member.edit', compact('room', 'user'));
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
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'cccd' => 'required',
            'address' => 'required',
        ]);

        $user->update($request->all());
        return redirect()->back()->with('message', 'Sửa thông tin thành công');
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

        $user->delete();
        return redirect()->route('admin.member.index')->with('message', 'Xóa thành công');
    }
}
