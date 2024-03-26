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
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }
    public function create() 
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'method' => 'required',
        ]);
        $data = $request->all();
        Service::query()->create($data);
        return back()->with('msg', 'Thêm dịch vụ thành công');
    }
    public function edit(Service $service)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('service'));
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
