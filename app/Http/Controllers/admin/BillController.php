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
use Barryvdh\DomPDF\Facade\Pdf;

class BillController extends Controller
{

    const PATH_VIEW = 'admin.bill.';

  
    public function index()
    {
        // $room = Room::query()->pluck('name','id');
        // return view(self::PATH_VIEW.__FUNCTION__,compact('room'));
        $water = Water_usage::all();
        $bills = Bill::query()->with('room')->latest()->paginate(5);
        $room = Room::query()->pluck('name','id');

        return view(self::PATH_VIEW.__FUNCTION__,compact('room','bills','water'));
    }

    
   
    public function store(Request $request)
    {
       
        $id = $request->room_id;
        $room = Room::find($id);
        // dd($room);
        $year = date('Y', strtotime($request->date_time));
        $month = date('n', strtotime($request->date_time));
        // dd($month);
       
        

    //     $bill_room = DB::table('bills')->where('room_id','=',$id)->whereYear('date_time', $year)->whereMonth('date_time', $month)->get()[0];
   
        // Tinh tien phong
        $price_room = $room->price;

        // Tinh tien dien
    
        $electricity = DB::table('electricity_usage')->where('room_id','=',$id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get();
        if(count($electricity)){
            $electricity = $electricity[0];
        }else{
            return back()->with('msg','Tháng này chưa có số nước');
        } 
        $electricity_service_id = $electricity->service_id;
        $electricity_service = Service::find($electricity_service_id);
        $electricity_price = $electricity_service->price;
        $electricity_Total = $electricity->used_electricity * $electricity_price;
        

        // Tinh tien nuoc
        $water = DB::table('water_usage')->where('room_id','=',$id)->whereYear('date_time', $year )->whereMonth('date_time',$month)->get();
       
        if(count($water)){
            $water = $water[0];
        }else{
            return back()->with('msg','Tháng này chưa có số điện');
        } 
        $water_service_id = $water->service_id;
        $water_service = Service::find($water_service_id);
        $water_price = $water_service->price;
        $water_Total = $water->used_water * $water_price;

        
        // Tinh tien dich vu
        $room_services = DB::table('room_service')->where('room_id', '=', $id)->get();
        $array_room = [];
        $array_member = [];
        $total_service_price = 0;

          foreach ($room_services as $item) {
            
            $service = DB::table('services')->where('id', '=', $item->service_id)->get()[0];
           
            
            if($service->id == $water_service->id || $service->id == $electricity_service->id) {
                continue;
            }
            
            if($service->method == 0) {
                $key = $service->name;
                $value = $service->price * $room->member_quantity;
                array_push($array_member, [$key=>$value]);
                $garbage_price = ($service->price * $room->member_quantity) ;
                
                
            }else {
                $key = $service->name;
                $value = $service->price ;
                array_push($array_room, [$key=>$value]);
                $wifi_price = $service->price;
                
            }
           
            }
            $total_service_price = $electricity_Total + $water_Total +  $garbage_price + $wifi_price ;
           
      
        
        

        // Tong tien
        $total_price = $price_room + $total_service_price;
        
        // Them hoa don
        $bill = Bill::create(['room_id' => $room->id,
            'total_price'           => $total_price,
            'remaining_amount'      => $total_price,
            'total_price_service'   => $total_service_price,
            'note'                  => $request->note,
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
            'current_water'         => $water->current_water, 
            'water_price'           => $water_service->price,
            'pre_electricity'       => $electricity->pre_electricity, 
            'current_electricity'   => $electricity->current_electricity,
            'electricity_price'     => $electricity_service->price, 
            'wifi_price'            => $wifi_price, 
            'garbage_price'         => $garbage_price, 
            'total_price_service'   => $bill_detail->total_price_service
        ]);
        // Them chi tiết hóa đơn
        return redirect()->back();
    }

   
    public function show(String $id)
    {
        $id_detail = $id;
        
        $bill_details = Bill_detail::where('bill_id', $id_detail)->get();
        
       

        return view(self::PATH_VIEW.__FUNCTION__,compact('bill_details','$used_water','$used_electricity'));
        
    }

    // view pdf
    public function generatePDF(String $id) {
        $id_detail = $id;
        $bill_details = Bill_detail::where('bill_id', $id_detail)->get();
       
        $used_water = 0;
        $used_electricity = 0;
    
       
    
        foreach ($bill_details as $detail) {
            $used_water += $detail->current_water - $detail->pre_water;
            $used_electricity += $detail->current_electricity - $detail->pre_electricity;
            $water_price = $detail->water_price;
            $electricity_price =  $detail->electricity_price;
            $room_price = $detail->room_price;
            $garbage_price = $detail->garbage_price;
            $wifi_price = $detail->wifi_price;

        }
    
       
        $water_Total = $used_water * $water_price;
        $electricity_Total = $used_electricity * $electricity_price;
        $total_price = $water_Total + $electricity_Total + $room_price + $garbage_price + $wifi_price;
    
        $data = $bill_details->toArray();
    
        $pdf = Pdf::loadView('admin.bill.show', [
            'bill_details' => $data,
            'used_water' => $used_water,
            'used_electricity' => $used_electricity,
            'water_Total' => $water_Total,
            'electricity_Total' => $electricity_Total,
            'total_price' => $total_price
        ]);
    
        return $pdf->stream('show.pdf');
    }
}
