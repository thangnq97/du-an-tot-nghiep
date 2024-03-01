<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Rooms;
use App\Models\Water_usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WaterController extends Controller
{

    const PATH_VIEW = 'admin.water.';
    const PATH_UPLOAD = 'admin.water';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $room = Room::query()->pluck('name','id');
        // return view(self::PATH_VIEW.__FUNCTION__,compact('room'));
        $data = Water_usage::query()->with('room')->latest()->paginate(5);

        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $room = Room::query()->pluck('name','id');
        return view(self::PATH_VIEW.__FUNCTION__,compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate ([
            'room_id' => 'required',
            'pre_water' => 'required|numeric',
            'current_water' => 'required|numeric|gt:pre_water',
            'date_time' => 'required|date',
            
        ]);

        
        // dd($request->date_time);
        // $data = $request->except('img');

        // // $date = "2012-01-05";

       
        $year = date('Y', strtotime($request->date_time));

        $month = date('n', strtotime($request->date_time));
        // // dd($year,$month);
        // if($request->date_time == )
        $water_usage = DB::table('water_usage')->where('room_id','=',$request->room_id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get();
        // dd(count($water_usage));
        if(count($water_usage)){
            return back()->with('msg','khong duoc');
        }
        $data = $request->all();
        // if ($request->hasFile('img')) {
        //     $data['img'] = Storage::put(self::PATH_UPLOAD,$request->file('img'));
        // }
        Water_usage::query()->create($data);
        return back()->with('msg','Lưu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Water_usage $Water_usage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)

    {
        $Water_usage = Water_usage::find($id);
        $room = Room::query()->pluck('name','id');
        return view(self::PATH_VIEW.__FUNCTION__,compact('Water_usage','room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate ([
            'room_id' => 'required',
            'pre_water' => 'required|numeric',
            'current_water' => 'required|numeric|gt:pre_water',
            'date_time' => 'required|date',
            
        ]);
        $data = $request->all();
        $water = Water_usage::findOrFail($id);
        $water->update($data);
        
        
        // if($request->hasFile('img') && Storage::exists('img')){
        //     Storage::delete($old);
        // }
        return back()->with('msg','sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Water_usage $Water_usage)
    {
        //
    }

}
