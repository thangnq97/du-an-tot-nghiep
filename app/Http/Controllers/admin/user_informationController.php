<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Room;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class user_informationController extends Controller
{
    const PATH_VIEW = 'admin.user_information.';
    const PATH_UPLOAD = 'admin.user_information';
    public function index(Request $request)
    {
        $query = User::query()->latest();
        $title = 'Danh sách khách hàng';
    
        // Handle search
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
    
        // Check condition for role id
        $roleId = 1; // Change this value based on your requirement
        if (Role::where('id', $roleId)->first()) {
            $users = $query->paginate(5);
            return view(self::PATH_VIEW . __FUNCTION__, compact('users', 'title'));
        } else {
            // Handle the case when the condition is not met
            // For example, you can redirect to another page
            return redirect()->route('some.other.route');
        }
    }

    // public function create()
    // {
    //     $users = User::latest()->pluck('name', 'id')->all();

    //     return view(self::PATH_VIEW . __FUNCTION__, compact('users'));
    // }

    // public function store(Request $request)
    // {

    //     $request->validate(
    //         [
    //             'user_id' => 'required',
    //             'sex' => 'required',
    //             'year' => 'required',
    //             'license_plates' => 'required',
    //             'note' => 'required'

    //         ],
    //         [
    //             'user_id.required' => 'Không được để trống',
    //             'sex.required' => 'Không được để trống',
    //             'year.required' => 'Không được để trống',
    //             'license_plates.required' => 'Không được để trống',
    //             'note.required' => 'Không được để trống'
    //         ]
    //     );


    //     User::create($request->all());
    //     return back()->with('msg', 'Thêm Thành Công');
    // }
    public function edit(string $id)
    {

        $users = User::latest()->pluck('name', 'id')->all();
        $user_information = User::find($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('users', 'user_information'));
    }
    // public function update(Request $request, string $id)
    // {
    //     $user_information = User::find($id);


    //     $user_information->update($request->all());


    //     return back()->with('msg', 'Sửa Thành Công');
    // }

    // public function destroy(string $id)
    // {
    //     $user_information = User::find($id);
    //     $user_information->delete();
    //     return back()->with('msg', 'Xóa Thành Công');
    // }
}
