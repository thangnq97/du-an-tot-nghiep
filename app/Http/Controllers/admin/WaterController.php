<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Rooms;
use App\Models\Service;
use App\Models\Water_usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class WaterController extends Controller
{

    const PATH_VIEW = 'admin.water.';
    const PATH_UPLOAD = 'admin.water';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Quản lí nước';
        $room = Room::query()->pluck('name', 'id');
        $data = Water_usage::query()->with('room')->orderBy('id', 'DESC')->paginate(5);
        $water_date = Water_usage::query()->with('room')->orderBy('id', 'DESC')->paginate(5);

        $room_id = $request->room;
        $date_time = $request->date_time;
        // dd($date_time);

        $WaterByRoom = DB::table('water_usage')->where('room_id', $room_id)->get();
        $WaterByDateTime = DB::table('water_usage')->where('date_time', $date_time)->get();

        if ($WaterByRoom->isNotEmpty() && $WaterByDateTime->isNotEmpty()) {
            $data = Water_usage::query()->with('room')->where('room_id', $room_id)->where('date_time', $date_time)->latest()->paginate(5);
        } elseif ($WaterByRoom->isNotEmpty()) {
            $data = Water_usage::query()->with('room')->where('room_id', $room_id)->latest()->paginate(5);
        } elseif ($WaterByDateTime->isNotEmpty()) {
            $data = Water_usage::query()->with('room')->where('date_time', $date_time)->latest()->paginate(5);
        } else {
            $data = Water_usage::query()->with('room')->latest()->paginate(5);
        }



        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'title', 'room', 'water_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lí nước';
        $room = Room::query()->pluck('name', 'id');
        $services = Service::query()->pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('room', 'services', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'room_id' => [
                    'required',
                ],
                'pre_water' => 'required|numeric',
                'current_water' => 'required|numeric|gt:pre_water',
                'date_time' => 'required|date',

                'service_id' => [
                    'required',

                ],
            ],
            [
                'room_id.required' => 'Không được để trống',
                'pre_water.required' => ' Không được để trống',
                'current_water.required' => 'Không được để trống',
                'date_time.required' => 'Không được để trống',
                'pre_water.numeric' => 'Phải là dạng số',
                'date_time.current_water' => 'Phải là dạng số',
                'date_time.date' => 'Vui lòng nhập đúng định dạng',
                'current_water.gt' => 'Chỉ số mới phải lớn hơn chỉ số cũ',

            ]
        );


        $year = date('Y', strtotime($request->date_time));

        $month = date('n', strtotime($request->date_time));
        // // dd($year,$month);
        // if($request->date_time == )
        $water_usage = DB::table('water_usage')->where('room_id', '=', $request->room_id)->whereYear('date_time', $year)->whereMonth('date_time', $month)->get();
        if (count($water_usage)) {
            return back()->with('msc', 'đã nhập số điện tháng này');
        }
        $data = $request->all();
        // if ($request->hasFile('img')) {
        //     $data['img'] = Storage::put(self::PATH_UPLOAD,$request->file('img'));
        // }
        Water_usage::query()->create($data);
        return back()->with('msg', 'Lưu thành công');
    }



    public function edit(String $id)

    {
        $title = 'Quản lí nước';
        $Water_usage = Water_usage::find($id);
        $room = Room::query()->pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('Water_usage', 'room', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'room_id' => 'required',
                'pre_water' => 'required|numeric',
                'current_water' => 'required|numeric|gt:pre_water',
                'date_time' => 'required|date',
            ],
            [
                'room_id.required' => 'Không được để trống',
                'pre_water.required' => ' Không được để trống',
                'current_water.required' => 'Không được để trống',
                'date_time.required' => 'Không được để trống',
                'pre_water.numeric' => 'Phải là dạng số',
                'date_time.current_water' => 'Phải là dạng số',
                'date_time.date' => 'Vui lòng nhập đúng định dạng',
            ]

        );
        $data = $request->all();
        $water = Water_usage::findOrFail($id);
        $water->update($data);


        return back()->with('msg', 'sửa thành công');
    }
}
