<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Users;
use Illuminate\Http\Request;

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
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function store(Request $request)
    {
      

     
        Users::create($request->all());
        return back()->with('msg', 'them thanh cong');
    }
}
