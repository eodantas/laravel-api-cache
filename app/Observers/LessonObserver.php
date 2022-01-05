<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Str;

class LessonObserver
{
    /**
     * Handle the Course "creatng" event.
     *
     * @param  \App\Models\Lesson  $course
     * @return void
     */
    public function creating(Lesson $lesson)
    {
        $lesson->uuid = (string) Str::uuid();
    }
}
