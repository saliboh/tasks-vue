<?php

namespace Tests\Unit\Models;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->task = Task::factory()->create();
    }

    /**
     * @test
     */
    public function checkIfTasksTableExists(): void
    {
        $this->assertTrue(Schema::hasTable($this->task->getTable()));
    }
}
