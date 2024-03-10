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

class AdminHomeController extends Controller
{

    public function index() {
        $title = 'Trang chủ';
        return view('admin.account.index', compact('title'));
    }

    public function login() {
        return view('admin.account.login');
    }

    public function saveLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 1])) {
            return redirect()->route('admin.index');
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
