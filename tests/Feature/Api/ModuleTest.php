<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_modules_by_course()
    {
        $course = Course::factory()->create();
        Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->uuid}/modules");

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_notfound_modules_by_course()
    {
        $response = $this->getJson("/courses/fake_data/modules");

        $response->assertStatus(404);
    }

    public function test_get_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->uuid}/modules/{$module->uuid}");

        $response->assertStatus(200);
    }

    public function test_validation_create_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->postJson("/courses/{$course->uuid}/modules", []);

        $response->assertStatus(422);
    }

    public function test_create_module_by_course()
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/courses/{$course->uuid}/modules", [
            'course_id' => $course->id,
            'name' => 'Modulo 1'
        ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->putJson("/courses/{$course->uuid}/modules/{$module->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->putJson("/courses/{$course->uuid}/modules/{$module->uuid}", [
            'name' => 'Modulo 1'
        ]);

        $response->assertStatus(200);
    }

    public function test_404_delete_module_by_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/courses/{$course->uuid}/modules/fake-data");

        $response->assertStatus(404);
    }

    public function test_delete_module_by_course()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create([
            'course_id' => $course->id
        ]);

        $response = $this->deleteJson("/courses/{$course->uuid}/modules/{$module->uuid}");

        $response->assertStatus(204);
    }
}
