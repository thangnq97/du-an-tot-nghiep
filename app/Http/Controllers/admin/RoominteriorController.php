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
            ],
            'status' => 'required|numeric|between:50,100',
            'price' => 'required|numeric|gt:1000',
            'quantity' => 'required|numeric',

        ]);

        Room_interior::create($request->all());
        return back()->with('msg', 'Thao tác thành công');
    }
    public function edit(string $id)
    {
        $interiors = Interior::latest()->pluck('name', 'id')->all();
        $rooms = Room::latest()->pluck('name', 'id')->all();
        $room_interior = Room_interior::find($id);
        return view(self::PATH_VIEW . __FUNCTION__,compact('interiors', 'rooms', 'room_interior'));
    }

    public function update(Request $request, string $id)
    {
        $room_interior= Room_interior::find($id);
        $request->validate([
            'interior_id' => [
                'required',
                Rule::exists('interiors', 'id')
            ],
            'room_id' => [
                'required',
                Rule::exists('rooms', 'id')
            ],
            'status' => 'required|numeric|between:50,100',
            'price' => 'required|numeric|gt:1000',
            'quantity' => 'required|numeric',

        ]);

        $room_interior->update($request->all());


        return back()->with('msg', 'sua thanh cong');
    }


    public function destroy(string $id)
    {
        $interior= Room_interior::find($id);
        $interior->delete();
        return back()->with('msg', 'xoa thanh cong');
    }
}
