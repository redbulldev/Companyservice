<?php

declare(strict_types=1);

namespace Companyservice\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Companyservice\Repositories\Contracts\ServiceRepositoryInterface;
use Companyservice\Http\Requests\ServiceRequest;
use Illuminate\Support\Str;
use Auth;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(ServiceRepositoryInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->service->all(['id', 'service_name', 'slug', 'price', 'package', 'effective_time', 'display_position', 'feature', 'user_id', 'status']);

        return view('companybase::admin.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companybase::admin.service.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        try {
            $this->service->store(
                array_merge(
                    $request->validated(),
                    [
                        'slug' => Str::slug($request->service_name),
                        'user_id' => Auth::user()->id
                    ])
            );

            return redirect()->back()->withInput($request->input())->with('message','Thêm thành công');
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().' --line '.$exception->getLine());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $service = $this->service->findByid($id);

        return view('companybase::admin.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, int $id)
    {
        try {
            $service = array_merge(
                $request->validated(),
                [
                    'slug' => Str::slug($request->service_name)
                ]
            );

            $this->service->update($id, $service);

            return redirect()->route('service.index')->with('message','Sửa thành công');
        } catch (Exception $exception) {
            Log::error('error(loi):'.$exception->getMessage().' --line '.$exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);

            return redirect()->route('service.index')->with('message','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().' --line '.$e->getLine());
        }
    }
}
