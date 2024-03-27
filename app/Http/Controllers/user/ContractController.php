<?php

namespace App\Http\Controllers\user;

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
}