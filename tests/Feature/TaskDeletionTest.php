<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_task()
    {
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        $task = Task::factory()->for($user)->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
