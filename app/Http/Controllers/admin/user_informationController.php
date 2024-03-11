<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\user_information;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class user_informationController extends Controller
{
    const PATH_VIEW = 'admin.user_information.';
    const PATH_UPLOAD = 'admin.user_information';
    public function index()
    {
        $user_information = user_information::query()->latest()->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('user_information'));
    }

    public function create()
    {
        $users = Users::latest()->pluck('name', 'id')->all();
        
        return view(self::PATH_VIEW . __FUNCTION__, compact('users'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->whereNotIn('id', [auth()->id()]);
                }),
                Rule::unique('user_information', 'user_id')->where(function ($query) {
                    return $query->whereNotIn('user_id', [auth()->id()]);
                })
            ],
           
            
        ]);


        user_information::create($request->all());
        return back()->with('msg', 'Thêm Thành Công');
    }
    public function edit(string $id)
    {
        
        $users = users::latest()->pluck('name', 'id')->all();
        $user_information = user_information::find($id);
        return view(self::PATH_VIEW . __FUNCTION__,compact('users', 'user_information'));
    }
    public function update(Request $request, string $id)
    {
        $user_information= user_information::find($id);
       

        $user_information->update($request->all());


        return back()->with('msg', 'Sửa Thành Công');
    }

    public function destroy(string $id)
    {
        $user_information= user_information::find($id);
        $user_information->delete();
        return back()->with('msg', 'Xóa Thành Công');
    }
}
