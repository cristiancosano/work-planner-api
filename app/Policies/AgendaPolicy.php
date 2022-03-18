<?php

namespace App\Policies;

use App\Models\Agenda;
use App\Models\Auditor;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AgendaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the auditor can view the agenda.
     *
     * @param Auditor $auditor
     * @param Agenda $agenda
     * @return Response
     */
    public function view(Auditor $auditor, Agenda $agenda)
    {
        return $agenda->auditor == null || $agenda->auditor == $auditor->id
            ? Response::allow()
            : Response::deny(
                "Agenda '$agenda->id' is reserved by other auditor. You don't have permission to show it."
            );
    }

    /**
     * Determine whether the auditor can update the agenda.
     *
     * @param Auditor $auditor
     * @param Agenda $agenda
     * @return Response
     */
    public function update(Auditor $auditor, Agenda $agenda)
    {
        return $agenda->auditor == null || $agenda->auditor == $auditor->id
            ? Response::allow()
            : Response::deny(
                "Agenda '$agenda->id' is reserved by other auditor. You don't have permission to reserve it."
            );;
    }
}
