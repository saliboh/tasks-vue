<?php

namespace App\Services;


use App\Models\Task;

class TaskService
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return Task::get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id)
    {
        $task = Task::find($id);

        return $task;
    }


    /**
     * @param array $data
     * @return Task
     */
    public function save(array $data)
    {
        if (isset($data['id'])) {
            $task = Task::findOrFail($data['id']);
            $task->title = $data['title'];
            $task->description = $data['description'];
            $task->due_date = $data['due_date'];
            $task->status = $data['status'];
        } else {
            $task = new Task($data);
        }

        $task->save();

        return $task;
    }
}
