<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        // return Cache::remember('courses', 60, function() {
        //     return $this->entity->with('modules.lessons')->get();
        // });

        // LEMBRA PARA SEMPRE
        return Cache::rememberForever('courses', function() {
            return $this->entity->with('modules.lessons')->get();
        });
    }

    public function store(array $data)
    {
        Cache::forget('courses');
        
        return $this->entity->create($data);
    }

    public function show(string $identify, bool $loadRelations = true)
    {
        $query = $this->entity->where('uuid', $identify);
        if ($loadRelations) {
            $query->with('modules.lessons');
        }
        return $query->firstOrFail();
    }

    public function destroy(string $identify)
    {
        $course = $this->show($identify, false);

        Cache::forget('courses');

        return $course->delete();
    }

    public function update(string $identify, array $data)
    {
        $course = $this->show($identify, false);

        Cache::forget('courses');

        return $course->update($data);
    }
}
