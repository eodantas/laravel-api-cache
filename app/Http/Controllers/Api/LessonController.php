<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module)
    {
        $lessons = $this->lessonService->getLessons($module);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($module, StoreUpdateLessonRequest $request)
    {
        $lesson = $this->lessonService->store($module, $request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($module, $identify)
    {
        $lesson = $this->lessonService->show($identify);

        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update($module, StoreUpdateLessonRequest $request, $identify)
    {
        $this->lessonService->update($module, $identify, $request->validated());

        return response()->json(['msg' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  strng  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($module, $identify)
    {
        $this->lessonService->destroy($identify);

        return response()->json([], 204);
    }
}
