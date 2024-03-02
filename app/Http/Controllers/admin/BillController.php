<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Electricity_usage;
use App\Models\Room;
use App\Models\Payment_method;
use App\Models\Room_service;
use App\Models\Rooms;
use App\Models\Service;
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
        $bills = Bill::query()->with('room')->latest()->paginate(5);
        $room = Room::query()->pluck('name','id');

        return view(self::PATH_VIEW.__FUNCTION__,compact('room','bills','water'));
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
       
        $id = $request->room_id;
        $room = Room::find($id);
        // dd($room);
        $year = date('Y', strtotime($request->date_time));
        $month = date('n', strtotime($request->date_time));
        // dd($month);
       
        

    //     $bill_room = DB::table('bills')->where('room_id','=',$id)->whereYear('date_time', $year)->whereMonth('date_time', $month)->get()[0];
    //    dd($bill_room);
    //    if($bill_room) {
    //         // return back();
    //     }

        // Tinh tien phong
        $price_room = $room->price;

        // Tinh tien dien
        // if(isset($year,$month)) {
        //     return back();
        // }
        
        $electricity = DB::table('electricity_usage')->where('room_id','=',$id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get()[0];
        $electricity = DB::table('electricity_usage')->where('room_id','=',$id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get()[0];
        $electricity_service_id = $electricity->service_id;
        $electricity_service = Service::find($electricity_service_id);
        $electricity_price = $electricity_service->price;

        // Tinh tien nuoc
        $water = DB::table('water_usage')->where('room_id','=',$id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get()[0];
        $water_service_id = $water->service_id;
        $water_service = Service::find($water_service_id);
        $water_price = $water_service->price;

        // Tinh tien dich vu
        $room_services = DB::table('room_service')->where('room_id', '=', $id)->get();
        $total_service_price = 0;

        foreach ($room_services as $item) {
            $service = DB::table('services')->where('id', '=', $item->service_id)->get()[0];
            if($service->id == $water_service->id || $service->id == $electricity_service->id) {
                continue;
            }
            if($service->method == 0) {
                $total_service_price += $service->price * $room->member_quantity;
            }else {
                $total_service_price += $service->price;
            }
        }

        // Tong tien
        $total_price = $price_room + ($water_price * $water->used_water) + ($electricity_price * $electricity->used_electricity) + $total_service_price;
        
        // Them bill
        $bill = Bill::create(['room_id' => $room->id,
            'total_price' => $total_price,
            'remaining_amount' => $total_price,
            'total_price_service' => $total_service_price,
            'note' => $request->note,
                            ]);
        // Them bill detail
       // Lấy giá trị ID lớn nhất
        $maxId = DB::table('bills')->max('id'); 
        $bill_detail = DB::table('bills')->where('id', $maxId)->get()[0];
        // dd($bill_detail->total_price_service);
        $bill_details = Bill_detail::create(['room_id' => $room->id,
            'bill_id'               => $bill_detail->id, 
            'room_name'             => $room->name,
            'room_price'            => $price_room,
            'date_start'            => $request->date_time, 
            'pre_water'             => $water->pre_water, 
            'current_water'         => $water->pre_water, 
            'water_price'           => $service->price,
            'pre_electricity'       => $water->pre_water, 
            'current_electricity'   => $water->pre_water,
            'electricity_price'     => $service->price, 
            'total_price_service'   => $bill_detail->total_price_service
        ]);
// Them bill detail
        // dd($bill_details);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        // dd($bill_detail);
        $id_detail = $id;
        
        $bill_details = Bill_detail::where('bill_id', $id_detail)->get();
        // dd($bill_details);

        return view(self::PATH_VIEW.__FUNCTION__,compact('bill_details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function update(Request $request, string $id)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill_detail $bill_detail)
    {
        //
    }

}
