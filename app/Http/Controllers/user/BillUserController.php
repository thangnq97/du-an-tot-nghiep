<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Bill_detail;
use App\Models\BillUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'user.bill.';
    public function index(Request $request)
    {
        $User_bill = Bill_detail::query()->latest()->paginate(5);
        // dd( $User_bill);
        // dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('User_bill'));
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
}
