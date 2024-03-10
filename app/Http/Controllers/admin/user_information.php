<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Users;
use App\Models\Room;
use Illuminate\Http\Request;

class user_information extends Controller
{
    const PATH_VIEW = 'admin.user_information.';
    const PATH_UPLOAD = 'admin.user_information';
    public function index()
    {
        // $users = Users::query()->latest()->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, );
    }
}
