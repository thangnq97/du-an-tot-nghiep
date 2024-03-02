<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Electricity_usage;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ElectricController extends Controller
{
    const PATH_VIEW = 'admin.electric.';
    // const PATH_UPLOAD = 'admin.electric';
    
    public function index(){
       $data = Electricity_usage::query()->latest()->paginate(5);
       return view(self::PATH_VIEW .__FUNCTION__, compact('data'));
    }
    public function create(){
        $rooms = Room::query()->pluck('name', 'id')->toArray();
        return view(self::PATH_VIEW .__FUNCTION__, compact('rooms'));
    }
    public function store(Request $request){
        $validated = $request->validate ([
            'room_id' => 'required',
            'pre_electricity' => 'required|numeric',
            'current_electricity' => 'required|numeric|gt:pre_electricity',
            'date_time' => 'required|date',
        ]);
        
        Electricity_usage::query()->create($request->all());
        return back()->with('msg', 'thao tac thanh cong');
    }

    public function edit(string $id){
        
        $electricity_usage = Electricity_usage::find($id);
        $rooms = Room::query()->pluck('name','id')->toArray();
        return view(self::PATH_VIEW.__FUNCTION__,compact('rooms','electricity_usage'));
    }

    public function update(Request $request, string $id ){
        $validated = $request->validate ([
            'room_id' => 'required',
            'pre_electricity' => 'required|numeric',
            'current_electricity' => 'required|numeric|gt:pre_electricity',
            'date_time' => 'required|date',
        ]);
        $data = $request->all();
        $electricity = Electricity_usage::findOrFail($id);
        $electricity->update($data);
        return back()->with('msg','sửa thành công');
    }
    
}
