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


    public function index(Request $request)
    {
        $title = 'Quản lí hóa đơn';
        $water = Water_usage::all();
        $room = Room::query()->pluck('name', 'id');
        $bills = Bill::query()->with('room')->latest()->paginate(5);
        $date_bill = Bill::query()->with('room')->latest()->paginate(5);
        $room_id = $request->room;
        $date_time = $request->date_time;
        // dd($date_time);

        $billByRoom = DB::table('bills')->where('room_id', $room_id)->get();
        $billByDateTime = DB::table('bills')->where('date_time', $date_time)->get();
        if ($billByRoom->isNotEmpty() && $billByRoom->isNotEmpty()) {
            $bills = Bill::query()->with('room')->where('room_id', $room_id)->where('date_time', $date_time)->latest()->paginate(5);
        } elseif ($billByRoom->isNotEmpty()) {
            $bills = Bill::query()->with('room')->where('room_id', $room_id)->latest()->paginate(5);
        } elseif ($billByDateTime->isNotEmpty()) {
            $bills = Bill::query()->with('room')->where('date_time', $date_time)->paginate(5);
        } else {
            $bills = Bill::query()->with('room')->latest()->paginate(5);
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('room', 'bills', 'water', 'title', 'date_bill'));
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                'date_time' => 'required',
            ],
            [
                'date_time.required' => 'Không được để trống',
            ]
        );

        $id = $request->room_id;
        $room = Room::find($id);

        $year = date('Y', strtotime($request->date_time));
        $month = date('n', strtotime($request->date_time));

        $bill_room = DB::table('bills')->where('room_id', '=', $id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();

        if (count($bill_room) > 0) {
            return back()->with('msg', 'Tháng này đã được tính tiền');
        }

        // Tinh tien phong
        $price_room = $room->price;

        // Tinh tien dien

        $electricity = DB::table('electricity_usage')->where('room_id', $id)->whereYear('date_time', $year)->whereMonth('date_time', '=', $month)->get();

        if (count($electricity)) {
            $electricity = $electricity[0];
        } else {
            return back()->with('msc', 'Tháng này chưa có số điện');
        }
        $electricity_service_id = $electricity->service_id;
        $electricity_service = Service::find($electricity_service_id);
        $electricity_price = $electricity_service->price;
        $electricity_Total = $electricity->used_electricity * $electricity_price;


        // Tinh tien nuoc
        $water = DB::table('water_usage')->where('room_id', '=', $id)->whereYear('date_time', $year)->whereMonth('date_time', $month)->get();

        if (count($water)) {
            $water = $water[0];
        } else {
            return back()->with('msc', 'Tháng này chưa có số nước');
        }
        $water_service_id = $water->service_id;
        $water_service = Service::find($water_service_id);
        $water_price = $water_service->price;
        $water_Total = $water->used_water * $water_price;


        // Tinh tien dich vu
        $room_services = DB::table('room_service')->where('room_id', '=', $id)->get();
        $array_room = [];
        $array_member = [];
        $total_member_service_price = 0;
        $total_room_service_price = 0;
        $description = "";
        $description_room = "";

        foreach ($room_services as $item) {

            $service = DB::table('services')->where('id', '=', $item->service_id)->first();

            if ($service->id == $water_service->id || $service->id == $electricity_service->id) {
                continue;
            }

            if ($service->method == 0) {
                $key = $service->name;

                $value = $service->price  * $room->member_quantity;
                array_push($array_member, [$key => $value]);
                $total_member_service_price += $value;  // Chỉ cộng giá dịch vụ một lần

            } else {
                $key = $service->name;
                $value = $service->price;
                array_push($array_room, [$key => $value]);
                $total_room_service_price += $value;
            }
        }


        foreach ($array_room as $item) {
            foreach ($item as $key => $value) {
                $sevice_price = $value;

                $description_room .=  '<p>' . $key . ' (Giá: ' . $sevice_price . ')' . '</p>' . '<p style="padding-left: 535px">' . $value . '</p>';
            }
        }

        foreach ($array_member as $item) {
            foreach ($item as $key => $value) {
                $sevice_price = $value / $room->member_quantity;

                $description .= '<p>' . $key . ' (Giá: ' . $sevice_price . 'ND: ' . $room->member_quantity . ')' . '</p>' . '<p style="padding-left: 510px">' . $value . '</p>';
            }
        }

        // Tổng tiền dịch vụ không thiết yếu
        $total_service_price = $total_member_service_price + $total_room_service_price;
        // Tong tien
        $total_price = $price_room + $total_member_service_price + $electricity_Total + $water_Total + $total_room_service_price;


        // Them hoa don
        $bill = Bill::create([
            'room_id' => $room->id,
            'total_price'           => $total_price,
            'remaining_amount'      => $total_price,
            'total_price_service'   => $total_service_price,
            'date_time'             => $request->date_time,
            'note'                  => $request->note,
            'total_price'           => $total_price,
        ]);

        // Them bill detail
        // Lấy giá trị ID lớn nhất
        $maxId = DB::table('bills')->max('id');
        $bill_detail = DB::table('bills')->where('id', $maxId)->get()[0];

        $bill_details = Bill_detail::create([
            'room_id' => $room->id,
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
            'total_price_service'   => $bill_detail->total_price_service,
            'number_member'         => $room->member_quantity,
            'description'           => $description,
            'description_room'      => $description_room

        ]);
        // Them chi tiết hóa đơn
        return redirect()->back();
    }


    // view pdf
    public function generatePDF(String $id)
    {
        $id_detail = $id;
        $bill_details = Bill_detail::where('bill_id', $id_detail)->get();


        $used_water = 0;
        $used_electricity = 0;



        foreach ($bill_details as $detail) {

            $total_price  = DB::table('bills')->where('id', $detail->bill_id)->get()[0];
            $used_water += $detail->current_water - $detail->pre_water;
            $used_electricity += $detail->current_electricity - $detail->pre_electricity;
            $water_price = $detail->water_price;
            $electricity_price =  $detail->electricity_price;
        }

        $water_Total = $used_water * $water_price;
        $electricity_Total = $used_electricity * $electricity_price;


        $data = $bill_details->toArray();

        $pdf = Pdf::loadView('admin.bill.show', [
            'bill_details' => $data,
            'used_water' => $used_water,
            'used_electricity' => $used_electricity,
            'water_Total' => $water_Total,
            'electricity_Total' => $electricity_Total,
            'total_price' => $total_price->total_price
        ]);

        return $pdf->stream('show.pdf');
    }

    // Thu tiền offline
    public function edit(string $id)
    {
        $title = 'Quản lí hóa đơn';
        $bill = Bill::find($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('bill', 'title'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'paid_amount' => 'required|numeric|min:1',
            ],
            [
                'paid_amount.required' => ' Không được để trống số tiền',
                'paid_amount.numeric' => 'Kiểu dữ liệu là dạng số',
                'paid_amount.min' => 'Giá trị phải lớn hơn 0',
            ]

        );



        $bill = Bill::find($id);

        $paid_amount = $bill->paid_amount + $request->paid_amount;
        $reamaining_amount = ($bill->total_price) - ($paid_amount);

        if ($paid_amount > $bill->total_price) {
            return back()->with('msc', 'Quá số tiền cần thu');
        }
        if ($paid_amount == $bill->total_price) {
            $is_paid = 1;
        } else {
            $is_paid = 0;
        }

        $data = [
            'room_id' => $bill->room_id,
            'total_price' => $bill->total_price,
            'remaining_amount' => $reamaining_amount,
            'total_price_service' => $bill->total_price_service,
            'date_time' => $bill->date_time,
            'paid_amount' => $paid_amount,
            'is_paid' =>  $is_paid,
            'payment_method_id' =>  $request->payment_method_id
        ];

        $bill->update($data);


        return back()->with('msg', 'Thu thành công');
    }
    //Xóa dữ liệu bảng bill theo id
    public function destroy(String $id)
    {
        $bill = Bill::find($id);
        $bill->delete();
        return back()->with('msc', 'Xóa thành công');
    }

    // lọc dữ liệu

}
