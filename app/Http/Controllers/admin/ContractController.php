<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ContractController extends Controller
{
    public function index(string $id) {
        $title = 'Quản lí phòng';
        $sub_title = 'contract';
        $room = Room::find($id);
        if(!$room) {
            return redirect()->route('admin.index');
        }
        $contract = DB::table('contracts')->where('room_id', '=', $id)->where('ended_at', '>=', now())->get();

        return view('admin.contract.index', compact('title', 'sub_title', 'room', 'contract'));
    }

    public function store(Request $request, string $id) {
        $room = Room::find($id);
        $contract = DB::table('contracts')->where('room_id', '=', $id)->where('ended_at', '>=', now())->get();
        if(count($contract)) {
            return redirect()->back()->with('error', 'Đã tồn tại hợp đồng không thể tạo mới');
        }
        $month_quantity = $request->month_quantity;

        $day = date('d', strtotime($request->started_at));
        $month = date('n', strtotime($request->started_at));
        $year = date('Y', strtotime($request->started_at));

        if($month + $month_quantity > 12) {
            $month = ($month + $month_quantity) % 12;
            $year += floor(($month + $month_quantity) / 12);
        }else {
            $month += $month_quantity;
        }

        $time = $year . '-' . $month . '-' . $day;
        $ended_at = new Carbon($time);

        Contract::create([
            'room_id' => $id,
            'ended_at' => $ended_at,
            'started_at' => $request->started_at,
            'month_quantity' => $month_quantity
        ]);
        
        return redirect()->back()->with('success', 'Tạo mới hợp đồng thành công');
    }

    public function viewContract(string $room_id, string $id) {
        $room = Room::find($room_id);
        $contract = Contract::find($id);

        $data = [
            'room' => $room,
            'contract' => $contract
        ];

        $pdf = Pdf::loadView('admin.pdf.contract_extension', $data);
        return $pdf->stream('hopdong.pdf');
    }
}