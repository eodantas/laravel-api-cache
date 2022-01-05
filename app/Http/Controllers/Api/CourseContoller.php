<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseContoller extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseService->getCourses();

        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCourseRequest $request)
    {
        $course = $this->courseService->store($request->validated());

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($identify)
    {
        $course = $this->courseService->show($identify);

        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCourseRequest $request, $identify)
    {
        $this->courseService->update($identify, $request->validated());

        return response()->json(['msg' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  strng  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($identify)
    {
        $this->courseService->destroy($identify);

        return response()->json([], 204);
    }
}
