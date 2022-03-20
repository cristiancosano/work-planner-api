<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgendaController extends Controller
{
    /**
     * Display a listing of agendas.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response
        (
            Agenda
                ::with('tasks')
                ->whereNull('auditor')
                ->paginate(15)
        );
    }

    /**
     * Display a listing of agendas that belong to the current user.
     *
     * @param Request $request
     * @return Response
     */

    public function indexByCurrentUser(Request $request): Response
    {
        return response(
            Agenda
                ::with('tasks')
                ->where('auditor', '=', $request->user()->id)
                ->paginate(15)
        );

    }

    /**
     * Display the agenda.
     *
     * @param Agenda $agenda
     * @return Response
     */
    public function show(Agenda $agenda): Response
    {
        $this->authorize('view', $agenda);
        return response($agenda->fresh('tasks'));
    }

    /**
     * Update the specified agenda in storage. The user who makes the request is assigned as current auditor.
     *
     * @param Request $request
     * @param Agenda $agenda
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, Agenda $agenda): Response
    {
        $this->authorize('update', $agenda);
        $agenda->auditor = $request->user()->id;
        return response(['saved' => $agenda->save()]);

    }
}
