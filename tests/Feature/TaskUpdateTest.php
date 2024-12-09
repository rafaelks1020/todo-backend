<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_task()
    {
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        $task = Task::factory()->for($user)->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Task',
            'description' => 'Updated description.',
            'completed' => true,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'Updated Task',
                     'description' => 'Updated description.',
                     'completed' => true,
                 ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Updated Task',
            'description' => 'Updated description.',
            'completed' => true,
        ]);
    }
}
