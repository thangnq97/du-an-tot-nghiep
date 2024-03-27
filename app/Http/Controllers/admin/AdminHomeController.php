<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\ActiveMailAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Charts\RoomChart;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminHomeController extends Controller
{

    public function index(Request $request, RoomChart $roomChart) {
        $chart = $roomChart->build();
        $title = 'Trang chủ';
        $filter = '';
        if($request->filter) {
            $filter = $request->filter;
        }else {
            $filter = 'month';
        }

        $chart_options = [
            'chart_title' => 'Doanh thu',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Bill',
            'group_by_field' => 'created_at',
            'group_by_period' => $filter,
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total_price',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        return view('admin.account.index', compact('title', 'chart', 'chart1'));
    }

    public function login() {
        if(Auth::user()) {
            if(Auth::user()->role_id == 1) {
                return redirect()->route('admin.index');
            }
            return redirect()->route('user.index');
        }
        return view('admin.account.login');
    }

    public function saveLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Không được để trống email',
            'email.email' => 'Bạn nhập phải là địa chỉ email hợp lệ',
            'password.required' => 'Không được để trống mật khẩu',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::user()->role_id == 1) {
                return redirect()->route('admin.index');
            }
            return redirect()->route('user.index');
        }

        return redirect()->back()->with('no', 'Sai tài khoản hoặc mật khẩu');
    }

    public function signOut() {
        Auth::logout();

        return redirect()->route('admin.login');
    }

    public function register() {
        return view('admin.account.register');
    }

    public function postRegister(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = strtoupper(Str::random(20));

        $request->merge(['token' => $token, 'password' => Hash::make($request->password)]);

        $user = User::create($request->all());
        $user->role_id = 1;

        $mailData = [
            'id' => $user->id,
            'name' => $user->name,
            'token' => $user->token
        ];

        Mail::to($user->email)->send(new ActiveMailAdmin($mailData));

        return redirect()->route('admin.login');
    }

    public function active(string $id, string $token) {
        $user = User::find($id);
        if($user->token === $token) {
            $user->is_active = 1;
            $user->token = strtoupper(Str::random(20));
            $user->save();
        }

        return redirect()->route('admin.login');
    }

}
