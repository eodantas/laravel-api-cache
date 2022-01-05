<?php

namespace App\Services;

use App\Repositories\ModuleRepository;
use App\Repositories\LessonRepository;

class LessonService
{
    protected $repository;
    protected $moduleRepository;

    public function __construct(LessonRepository $lessonRepository, ModuleRepository $moduleRepository)
    {
        $this->repository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessons(string $module)
    {
        $module = $this->moduleRepository->show($module);

        return $this->repository->getAllLessons($module->id);
    }

    public function store(string $module, array $data)
    {
        $module = $this->moduleRepository->show($module);

        $data['module_id'] = $module->id;

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

    public function update(string $module, string $identify, array $data)
    {
        $module = $this->moduleRepository->show($module);

        $data['module_id'] = $module->id;
        return $this->repository->update($identify, $data);
    }
}
