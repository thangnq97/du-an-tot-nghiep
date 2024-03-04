<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Users;
use App\Models\Room;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    const PATH_VIEW = 'admin.users.';
    const PATH_UPLOAD = 'admin.users';
    public function index()
    {
        $users = Users::query()->latest()->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('users'));
    }
    public function create()
    {
        $role = Role::latest()->pluck('name', 'id')->all();
        $rooms = Room::latest()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('role', 'rooms'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'role_id' => [
                'required',
                Rule::exists('roles', 'id')
            ],
            'room_id' => [
                'required',
                Rule::exists('rooms', 'id')
            ],
            'email' => 'required|email',
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/^0/'],
            'cccd' => ['required', 'numeric', 'digits:12'],
        ]);


        Users::create($request->all());
        return back()->with('msg', 'them thanh cong');
    }

    public function edit(string $id)
    {
        $role = Role::latest()->pluck('name', 'id')->all();
        $rooms = Room::latest()->pluck('name', 'id')->all();
        $users = Users::find($id);
        return view(self::PATH_VIEW . __FUNCTION__,compact('role', 'rooms', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $users= Users::find($id);
        $request->validate([
            'role_id' => [
                'required',
                Rule::exists('roles', 'id')
            ],
            'room_id' => [
                'required',
                Rule::exists('rooms', 'id')
            ],
            'email' => 'required|email',
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/^0/'],
            'cccd' => ['required', 'numeric', 'digits:12'],
        ]);

        $users->update($request->all());


        return back()->with('msg', 'sua thanh cong');
    }
    public function destroy(string $id)
    {
        $user= Users::find($id);
        $user->delete();
        return back()->with('msg', 'xoa thanh cong');
    }
}
