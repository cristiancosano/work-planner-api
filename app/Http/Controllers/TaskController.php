<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return Response
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return response($task->fresh(['agenda', 'agenda.auditor']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskUpdateRequest $request
     * @param Task $task
     * @return Response
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->review       = $request->get('review')       ?:  $task->review;
        $task->start_date   = $request->get('start_date')   ?:  $task->start_date;
        $task->end_date     = $request->get('end_date')     ?:  $task->end_date;

        return response(['saved' => $task->save()]);
    }
}
