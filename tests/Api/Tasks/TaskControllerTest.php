<?php

namespace Tests\API\V1\BestMe;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @var User
     */
    private User $user;

    /**
     * @var Task
     */
    private Task $task;

    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
        $this->user->name = 'Firstname';
        $this->user->email = 'test@gmail.com';
        $this->user->email_verified_at = now();
        $this->user->password = bcrypt('123123123');
        $this->user->remember_token = Str::random(10);
        $this->user->save();

        $this->task = Task::factory()->create();

        $this->actingAs($this->user);
    }

    /**
     * @test
     */
    public function indexReturnsStatus200(): void
    {
        $url = route('api.tasks.index');

        $this->get($url)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function showReturnsStatus200(): void
    {
        $url = route('api.tasks.get', ['id' => $this->task->id]);

        $this->get($url)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function showReturnsStatus404(): void
    {
        $url = route('api.tasks.get', ['id' => 0]);

        $this->get($url)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function storeReturnsStatus201(): void
    {
        $this->assertDatabaseCount('tasks', 1);

        $data = [
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'due_date' => now()->addMonth()->format('Y-m-d'),
            'status' => TaskStatusEnum::STARTED,
        ];

        $url = route('api.tasks.store');

        $this->post($url, $data)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseCount('tasks', 2);
    }

    /**
     * @test
     */
    public function updateReturnsStatus200(): void
    {
        $this->assertDatabaseCount('tasks', 1);

        $data = [
            'id' => $this->task->id,
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'due_date' => now()->addMonth()->format('Y-m-d'),
            'status' => TaskStatusEnum::STARTED,
        ];

        $url = route('api.tasks.update', ['id' => $this->task->id]);

        $this->put($url, $data)
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseCount('tasks', 1);
    }

    /**
     * @test
     */
    public function deleteReturnsStatus201(): void
    {
        $this->assertDatabaseCount('tasks', 1);


        $url = route('api.tasks.destroy', ['id' => $this->task ->id]);

        $this->delete($url)
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseCount('tasks', 0);
    }
}
