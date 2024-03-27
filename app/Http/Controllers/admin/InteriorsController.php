<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Interior;
use App\Models\Room_interior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InteriorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.interiors.';
    const PATH_UPLOAD = 'admin.interiors';
    public function index()
    {
        $interiors = Interior::query()->latest()->paginate(5);
        $title = 'Quản lí cơ sở vật chất';
        foreach ($interiors as $item) {
            $id = $item->id;
            $room_interior = DB::table('room_interior')->where('interior_id', $id)->sum('quantity');
            
            $item->remainingQuantity = $item->quantitys - $room_interior;
         
        };
        
        return view(self::PATH_VIEW . __FUNCTION__,compact('interiors','title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lí cơ sở vật chất';
        return view(self::PATH_VIEW . __FUNCTION__,compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        $request->validate(
            [
                'name' => 'required|unique:interiors|max:50',
                'quantitys' => 'required|numeric',

            ],
            [
                'quantity.required' => 'không được để trống',
                'name.required' => 'không được để trống',
                'name.unique' => 'Nội thất này đã có',
                'name.max' => 'Không được vượt quá 50 ký tự',
                'quantitys.numeric' => 'Phải là dạng số',



            ]
        );



        Interior::create($request->all());
        return back()->with('msg', 'Thêm Thành Công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interior $interior)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Quản lí cơ sở vật chất';
        $interior = Interior::find($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('interior','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $interior = Interior::find($id);
        $request->validate(
            [
                'name' => 'required|max:50',
                'quantitys' => 'required',

            ],
            [
                'quantitys.required' => 'không được để trống',
                'name.required' => 'không được để trống',
                'name.unique' => 'Nội thất này đã có',
                'name.max' => 'Không được vượt quá 50 ký tự',



            ]
        );

        $interior->update($request->all());


        return back()->with('msg', 'Sửa Thành Công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $interior = Interior::find($id);
        $interior->delete();
        return back()->with('msg', 'Xóa Thành Công');
    }
}
