<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room_interior;
use App\Models\Room;
use App\Models\Interior;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoominteriorController extends Controller
{
    const PATH_VIEW = 'admin.Room_interior.';
    const PATH_UPLOAD = 'admin.Room_interior';

    public function index()
    {
        $data = Room_interior::with('interior')->latest()->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $interiors = Interior::latest()->pluck('name', 'id')->all();
        $rooms = Room::latest()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('interiors', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'interior_id' => [
                'required',
                Rule::exists('interiors', 'id')
            ],
            'room_id' => [
                'required',
                Rule::exists('rooms', 'id')
            ]
        ]);

        Room_interior::create($request->all());
        return back()->with('msg', 'Thao tác thành công');
    }
}