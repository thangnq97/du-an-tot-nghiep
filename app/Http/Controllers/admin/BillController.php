<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Electricity_usage;
use App\Models\Room;
use App\Models\Payment_method;
use App\Models\Rooms;
use App\Models\Water_usage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BillController extends Controller
{

    const PATH_VIEW = 'admin.bill.';
    const PATH_UPLOAD = 'admin.water';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $room = Room::query()->pluck('name','id');
        // return view(self::PATH_VIEW.__FUNCTION__,compact('room'));
        $water = Water_usage::all();
        $bill = Bill::query()->with('room')->latest()->paginate(5);
        $room = Room::query()->pluck('name','id');

        return view(self::PATH_VIEW.__FUNCTION__,compact('room','bill','water'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
           
        // dd($water);
        // return view(self::PATH_VIEW.__FUNCTION__,compact('room','water'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
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
    public function demoShow(Request $request)

    {
        $id = $request->room_id;
        $room = Room::find($id);
        
        $year = date('Y', strtotime($request->date_time));
        $month = date('n', strtotime($request->date_time));
        $water = DB::table('water_usage')->where('room_id','=',$id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get();
      
        $price_room = $room->price;
      
        $electricity = DB::table('electricity_usage')->where('room_id','=',$id)->where('date_time', $year )->whereMonth('date_time',$month)->get();

        // $service = DB::table('service')->where('room_id','=',$id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get();
        // dd($water);
        return view(self::PATH_VIEW.__FUNCTION__,compact('water','price_room','electricity'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Water_usage $Water_usage)
    {
        //
    }

}
