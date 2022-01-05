<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course)
    {
        $modules = $this->moduleService->getModules($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($course, StoreUpdateModuleRequest $request)
    {
        $module = $this->moduleService->store($course, $request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($course, $identify)
    {
        $module = $this->moduleService->show($identify);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update($course, StoreUpdateModuleRequest $request, $identify)
    {
        $this->moduleService->update($course, $identify, $request->validated());

        return response()->json(['msg' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  strng  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($course, $identify)
    {
        $this->moduleService->destroy($identify);

        return response()->json([], 204);
    }
}
