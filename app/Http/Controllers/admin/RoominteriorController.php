<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room_interior;
use App\Models\Room;
use App\Models\Interior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoominteriorController extends Controller
{
    const PATH_VIEW = 'admin.Room_interior.';
    const PATH_UPLOAD = 'admin.Room_interior';

    public function index(Request $request)
    {
        $Room_interiors = Room_interior::query()->with('interior,room')->latest();
        $room = Room::query()->pluck('name', 'id');
        $interiors = Interior::query()->pluck('name', 'id');
        // dd($room);
        // $Name_interiors = Room_interior::with('interior')->latest();

        // Xử lý tìm kiếm
        $room_id = $request->room;
        $interior = $request->interior;
        // if ($request->has('search')) {
        // $searchTerm = $request->input('search');
        $room_interior = DB::table('room_interior')->where('room_id', $room_id)->get();
        $interior_id = DB::table('room_interior')->where('interior_id', $interior)->get();

        if ($room_interior->isNotEmpty() && $interior_id->isNotEmpty()) {
            $Room_interiors = Room_interior::query()->with('room')->where('room_id', $room_id)->where('interior_id', $interior)->latest()->paginate(5);
        } elseif ($room_interior->isNotEmpty()) {
            $Room_interiors = Room_interior::query()->with('room')->where('room_id', $room_id)->latest()->paginate(5);
        } elseif ($interior_id->isNotEmpty()) {
            $Room_interiors = Room_interior::query()->with('room')->where('interior_id', $interior)->latest()->paginate(5);
        } else {
            $Room_interiors = Room_interior::query()->with('room')->latest()->paginate(5);
        }
        // $query->whereHas('interior', function ($q) use ($searchTerm) {
        //     $q->where('name', 'LIKE', '%' . $searchTerm . '%');
        // });



        return view(self::PATH_VIEW . __FUNCTION__, compact('Room_interiors', 'room', 'interiors'));
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
            'quantity' => 'required',
            'status' => 'required|numeric|between:50,100',
            'price' => 'required|numeric|gt:1000',
            'description' => 'required',

            'interior_id' => [
                'required',
                Rule::exists('interiors', 'id')
            ],
            'room_id' => [
                'required',
                Rule::exists('rooms', 'id')
            ],
         
            'quantity' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $interior = Interior::find($request->input('interior_id'));
                    if ($interior && $value > $interior->quantitys) {
                        $fail('Số lượng bị vượt quá so với số lượng thực vui lòng kiểm tra lại');
                    }
                },
            ],
        ],
        [
            'quantity.required' => 'không được để trống',
            'status.required' => 'không được để trống',
            'status.numeric' => 'Phải là dạng số',
            'status.between' => 'Lớn hơn 50% và nhỏ hơn hoặc bằng 100%',
            'price.required' => 'không được để trống',
            'price.numeric' => 'Phải là dạng số',
            'price.gt' => 'Tối thiểu là 1000 VND',
            'description.required' => 'không được để trống',  
            'interior_id.required' => 'Không được để trống',
            'room_id.required' => 'Không được để trống'
        ]
    );

        Room_interior::create($request->all());
        return back()->with('msg', 'Thêm Thành Công');
    }
    public function edit(string $id)
    {
        $interiors = Interior::latest()->pluck('name', 'id')->all();
        $rooms = Room::latest()->pluck('name', 'id')->all();
        $room_interior = Room_interior::find($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('interiors', 'rooms', 'room_interior'));
    }

    public function update(Request $request, string $id)
    {
        $room_interior = Room_interior::find($id);
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
            'quantity' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $interior = Interior::find($request->input('interior_id'));
                    if ($interior && $value > $interior->quantitys) {
                        $fail('Số lượng bị vượt quá so với số lượng thực vui lòng kiểm tra lại');
                    }
                },
            ],

        ]
        ,
        [
            'quantity.required' => 'không được để trống',
            'status.required' => 'không được để trống',
            'status.numeric' => 'Phải là dạng số',
            'status.between' => 'Lớn hơn 50% và nhỏ hơn hoặc bằng 100%',
            'price.required' => 'không được để trống',
            'price.numeric' => 'Phải là dạng số',
            'price.gt' => 'Tối thiểu là 1000 VND',
            'description.required' => 'không được để trống',  
            'interior_id.required' => 'Không được để trống',
            'room_id.required' => 'Không được để trống'
        ]
    );

        $room_interior->update($request->all());


        return back()->with('msg', 'Sửa Thành Công');
    }


    public function destroy(string $id)
    {
        $interior = Room_interior::find($id);
        $interior->delete();
        return back()->with('msg', 'Xóa Thành Công');
    }
}
