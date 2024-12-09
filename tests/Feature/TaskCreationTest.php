<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'Task description',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'title', 'description', 'completed']);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'Task description',
            'user_id' => $user->id,
        ]);
    }
}