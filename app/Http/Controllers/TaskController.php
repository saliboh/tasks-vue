<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    public TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json()->setData($this->taskService->getAll());

    }

    /**
     * @param AddTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddTaskRequest $request)
    {
        try {
            $task = $this->taskService->save($request->validated());

            return response()->json($task, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        try {
            $task = $this->taskService->get($id);

            if (is_null($task)) {
                return response()->json([], Response::HTTP_NOT_FOUND);
            }

            return response()->json()->setData($task);
        } catch (\Exception $e) {
            response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param UpdateTaskRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $task = $this->taskService->save($request->validated());

            return response()->json()->setData($task);
        } catch (\Exception $e) {
            response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return response()->json([
                'message' => 'Deleted successfully.',
            ]);
        } catch (\Exception $e) {
            response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
