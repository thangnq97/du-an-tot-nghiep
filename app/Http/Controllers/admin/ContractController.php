<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ExtensionContract;
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
        $contract_extension = [];
        if(!$room) {
            return redirect()->route('admin.index');
        }
        $contract = DB::table('contracts')->where('room_id', '=', $id)->where('is_active', '=', true)->get();
        if(count($contract)) {
            $contract_extension = DB::table('extension_contracts')->where('contract_id', '=', $contract[0]->id)->get();
        }

        return view('admin.contract.index', compact('title', 'sub_title', 'room', 'contract', 'contract_extension'));
    }

    public function store(Request $request, string $id) {
        $room = Room::find($id);
        $contract = DB::table('contracts')->where('room_id', '=', $id)->where('is_active', '=', true)->get();
        if(count($contract)) {
            return redirect()->back()->with('error', 'Đã tồn tại hợp đồng không thể tạo mới');
        }
        $month_quantity = $request->month_quantity;

        // $day = date('d', strtotime($request->started_at));
        // $month = date('n', strtotime($request->started_at));
        // $year = date('Y', strtotime($request->started_at));

        Contract::create([
            'room_id' => $id,
            'started_at' => $request->started_at,
            'month_quantity' => $month_quantity
        ]);
        
        return redirect()->back()->with('success', 'Tạo mới hợp đồng thành công');
    }

    public function viewContract(string $room_id, string $id) {
        $room = Room::find($room_id);
        $contract = Contract::find($id);
        $owner = DB::table('users')->where('role_id', '=', 1)->get();
        $members = DB::table('users')->where('room_id', '=', $room->id)->where('is_active', '=', 1)->get();

        if(count($owner)) {
            $owner = $owner[0];
        }

        $data = [
            'room' => $room,
            'contract' => $contract,
            'owner' => $owner,
            'members' => $members
        ];

        $pdf = Pdf::loadView('admin.pdf.contract', $data);
        return $pdf->stream('hop_dong.pdf');
    }

    public function extension(Request $request, string $room) {
        $request->validate([
            'started_at' => 'required',
            'month_quantity' => 'required',
            'description' => 'required'
        ]);
        if($request->month_quantity <= 0) {
            return redirect()->back()->with('month_quantity', 'Thời hạn phải là số nguyên dương');
        }
        $contract = DB::table('contracts')->where('room_id', '=', $room)->get()[0];
        ExtensionContract::create([
            'contract_id' => $contract->id,
            'started_at' => $request->started_at,
            'month_quantity' => $request->month_quantity,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Thêm phụ lục thành công');
    }

    public function viewExtensionContract(string $room_id, string $id) {
        $room = Room::find($room_id);
        $extension_contract = ExtensionContract::find($id);
        $owner = DB::table('users')->where('role_id', '=', 1)->get();
        $contract = DB::table('contracts')->where('room_id', '=', $room_id)->get()[0];
        if(count($owner)) {
            $owner = $owner[0];
        }
        $members = DB::table('users')->where('room_id', '=', $room->id)->where('is_active', '=', 1)->get();

        $data = [
            'room' => $room,
            'extension_contract' => $extension_contract,
            'owner' => $owner,
            'members' => $members,
            'contract' => $contract
        ];

        $pdf = Pdf::loadView('admin.pdf.extension_contract', $data);
        return $pdf->stream('phu_luc_hop_dong.pdf');
    }

    public function createExtensionContract(string $room_id) {
        $room = Room::find($room_id);
        $title = 'Quản lí phòng';
        $sub_title = 'contract';
        $contract = DB::table('contracts')->where('room_id', '=', $room_id)->get();
        if(!count($contract)) {
            return redirect()->route('admin.index');
        }

        $contract = $contract[0];

        return view('admin.contract.extension', compact('title', 'sub_title', 'room'));
    }
}