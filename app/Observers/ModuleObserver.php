<?php

namespace App\Observers;

use App\Models\Module;
use Illuminate\Support\Str;

class ModuleObserver
{
    /**
     * Handle the Course "creatng" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function creating(Module $module)
    {
        $module->uuid = (string) Str::uuid();
    }
}
