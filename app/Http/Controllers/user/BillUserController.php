<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\BillUser;
use App\Models\Room;
use App\Models\Water_usage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'user.bill.';

    public function index()
    {
        $title = 'Quản lí hóa đơn';
        $water = Water_usage::all();
        $bills = Bill::query()->with('room')->latest()->paginate(5);
        $room = Room::query()->pluck('name', 'id');

        return view(self::PATH_VIEW . __FUNCTION__, compact('room', 'bills', 'water', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BillUser $billUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillUser $billUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillUser $billUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillUser $billUser)
    {
        //
    }

    // view pdf
    public function generatePDF(String $id)
    {
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

        $pdf = Pdf::loadView('user.bill.show', [
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
