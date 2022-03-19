<?php

namespace App\Policies;

use App\Models\Auditor;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param  Auditor  $auditor
     * @param  Task  $task
     * @return Response
     */
    public function view(Auditor $auditor, Task $task)
    {
        $agenda_auditor = $task->agenda()->first('auditor')->auditor;
        return  $agenda_auditor === null || $agenda_auditor === $auditor->id
            ? Response::allow()
            : Response::deny(
                "Task '$task->id' is reserved in an agenda owned by other auditor. You don't have permission to show it."
            );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  Auditor  $auditor
     * @param  Task  $task
     * @return Response
     */
    public function update(Auditor $auditor, Task $task): Response
    {
        $agenda_auditor = $task->agenda()->first('auditor')->auditor;
        return $auditor->id === $agenda_auditor
            ? Response::allow()
            : Response::deny(
                "You only can update your own tasks."
            );;
    }
}
