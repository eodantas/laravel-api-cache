<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    public function getCourses()
    {
        return $this->repository->getAllCourses();
    }

    public function store(array $data)
    {
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

    public function update(string $identify, array $data)
    {
        return $this->repository->update($identify, $data);
    }
}
