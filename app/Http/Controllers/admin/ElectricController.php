<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Electricity_usage;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ElectricController extends Controller
{
    const PATH_VIEW = 'admin.electric.';
    // const PATH_UPLOAD = 'admin.electric';

    public function index()
    {
        $title = 'Quản lí điện';
        $data = Electricity_usage::query()->latest()->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data','title'));
    }
    public function create()
    {
        $title = 'Quản lí điện';
        $rooms = Room::query()->pluck('name', 'id');
        $services = Service::query()->pluck('name', 'id');
        // dd($services);
        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms', 'services','title'));
    }
    public function store(Request $request)
    {
       
        $validated = $request->validate(
            [
                'room_id' => 'required',
                'pre_electricity' => 'required|numeric',
                'current_electricity' => 'required|numeric|gt:pre_electricity',
                'date_time' => 'required|date',
                'service_id' => 'required'
            ],
            [
                'room_id.required' => 'Không được để trống',
                'pre_electricity.required' => ' Không được để trống',
                'current_electricity.required' => 'Không được để trống',
                'date_time.required' => 'Không được để trống',
                'pre_electricity.numeric' => 'Phải là dạng số',
                'date_time.current_electricity' => 'Phải là dạng số',
                'date_time.date' => 'Vui lòng nhập đúng định dạng',

            ],
        );
       
        $year = date('Y', strtotime($request->date_time));

        $month = date('n', strtotime($request->date_time));

        $electricity_usage = DB::table('electricity_usage')->where('room_id', '=', $request->room_id)->whereYear('date_time', $year)->whereMonth('date_time', $month)->get();
        // dd(count($electricity_usage));
        if (count($electricity_usage)) {
            return back()->with('msg', 'Không được');
        }
        $data = $request->all();
        // if ($request->hasFile('img')) {
        //     $data['img'] = Storage::put(self::PATH_UPLOAD,$request->file('img'));
        // }
        Electricity_usage::query()->create($data);
        return back()->with('msg', 'Lưu thành công');
    }

    public function edit(string $id)
    {

        $electricity_usage = Electricity_usage::find($id);
        $rooms = Room::query()->pluck('name', 'id')->toArray();
        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms', 'electricity_usage'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'room_id' => 'required',
                'pre_electricity' => 'required|numeric',
                'current_electricity' => 'required|numeric|gt:pre_electricity',
                'date_time' => 'required|date',
            ],
            [
                'room_id.required' => 'Không được để trống',
                'pre_electricity.required' => ' Không được để trống',
                'current_electricity.required' => 'Không được để trống',
                'date_time.required' => 'Không được để trống',
                'pre_electricity.numeric' => 'Phải là dạng số',
                'date_time.current_electricity' => 'Phải là dạng số',
                'date_time.date' => 'Vui lòng nhập đúng định dạng',

            ],
        );
        $data = $request->all();
        $electricity = Electricity_usage::findOrFail($id);
        $electricity->update($data);
        return back()->with('msg', 'sửa thành công');
    }
}
