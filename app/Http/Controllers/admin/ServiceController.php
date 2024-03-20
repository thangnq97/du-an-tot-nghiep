<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    const PATH_VIEW = 'admin.services.';
    public function index()
    {
        $data = Service::query()->paginate();
        $title = 'Quản lí dịch vụ';
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'title'));
    }
    public function create()
    {
        $title = 'Quản lí dịch vụ';
        return view(self::PATH_VIEW . __FUNCTION__, compact('title'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
            ],
            [
                'name.required' => 'Không được để trống tên',
                'price.required' => 'Không được để trống giá',
            ]
        );
        $data = $request->all();
        Service::query()->create($data);
        return back()->with('msg', 'Thêm dịch vụ thành công');
    }
    public function edit(Service $service)
    {
        $title = 'Quản lí dịch vụ';
        return view(self::PATH_VIEW . __FUNCTION__, compact('service', 'title'));
    }
    public function update(Request $request, Service $service)
    {
        $data = $request->all();
        $service->update($data);
        return back()->with('msg', 'Sửa dịch vụ thành công');
    }
    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('msg', 'xóa dịch vụ thành công');
    }
}
