<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleService
{
    protected $repository;
    protected $courseRepository;

    public function __construct(ModuleRepository $moduleRepository, CourseRepository $courseRepository)
    {
        $this->repository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getModules(string $course)
    {
        $course = $this->courseRepository->show($course);

        return $this->repository->getAllModules($course->id);
    }

    public function store(string $course, array $data)
    {
        $course = $this->courseRepository->show($course);

        $data['course_id'] = $course->id;
        
        return $this->repository->store($data);
    }

    public function show(string $identify)
    {
        return $this->repository->show($identify);
    }

    public function destroy(string $identify)
    {
        return $this->repository->destroy($identify);
    }

    public function update(string $course, string $identify, array $data)
    {
        $course = $this->courseRepository->show($course);

        $data['course_id'] = $course->id;
        return $this->repository->update($identify, $data);
    }
}
