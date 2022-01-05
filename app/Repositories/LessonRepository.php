<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getAllLessons(int $moduleId)
    {
        return $this->entity::where('module_id', $moduleId)->get();
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
        $lesson = $this->entity::where('uuid', $identify)->firstOrFail();

        return $lesson->delete();
    }

    public function update(string $identify, array $data)
    {
        $lesson = $this->entity::where('uuid', $identify)->firstOrFail();

        return $lesson->update($data);
    }
}
