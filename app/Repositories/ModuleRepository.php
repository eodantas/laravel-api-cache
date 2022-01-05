<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getAllModules(int $courseId)
    {
        return $this->entity::where('course_id', $courseId)->get();
    }

    public function store(array $data)
    {
        return $this->entity->create($data);
    }

    public function show(string $identify)
    {
        return $this->entity::where('uuid', $identify)->firstOrFail();
    }

    public function destroy(string $identify)
    {
        $module = $this->entity::where('uuid', $identify)->firstOrFail();

        return $module->delete();
    }

    public function update(string $identify, array $data)
    {
        $module = $this->entity::where('uuid', $identify)->firstOrFail();

        return $module->update($data);
    }
}
