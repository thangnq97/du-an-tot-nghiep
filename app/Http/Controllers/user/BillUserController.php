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
        $title = 'Xem hóa đơn';
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

            $total_price  = DB::table('bills')->where('id', $detail->bill_id)->get()[0];
            $used_water += $detail->current_water - $detail->pre_water;
            $used_electricity += $detail->current_electricity - $detail->pre_electricity;
            $water_price = $detail->water_price;
            $electricity_price =  $detail->electricity_price;
        }

        $water_Total = $used_water * $water_price;
        $electricity_Total = $used_electricity * $electricity_price;


        $data = $bill_details->toArray();

        $pdf = Pdf::loadView('user.bill.show', [
            'bill_details' => $data,
            'used_water' => $used_water,
            'used_electricity' => $used_electricity,
            'water_Total' => $water_Total,
            'electricity_Total' => $electricity_Total,
            'total_price' => $total_price->total_price
        ]);

        return $pdf->stream('show.pdf');
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function payment(string $bill_id) {
        $bill = Bill::find($bill_id);
        if($bill->remaining_amount == 0) {
            return 'Đã thanh toán';
        }
        //thanh toan

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $bill->remaining_amount;
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/handle";
        $ipnUrl = "http://127.0.0.1:8000/handle";
        $extraData = $bill->id;



        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true);  // decode json
        // dd($jsonResult);
        
        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
        // header('Location: ' . $jsonResult['payUrl']);
    }

    public function handle(Request $request) {
        if($request->message == 'Successful.') {
            $bill_id = $request->extraData;
            $bill = Bill::find($bill_id);
            $bill->paid_amount = $bill->total_price;
            $bill->remaining_amount = 0;
            $bill->save();
            return 'Thành công';
        } else {
            return 'Thất bại';
        }
    }
}
