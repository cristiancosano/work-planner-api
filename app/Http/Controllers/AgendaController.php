<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
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
     * Display the agenda.
     *
     * @param Agenda $agenda
     * @return Response
     */
    public function show(Agenda $agenda): Response
    {
        return response($agenda->fresh('tasks'));
    }

    /**
     * Update the specified agenda in storage.
     *
     * @param Request $request
     * @param Agenda $agenda
     * @return Response
     */
    public function update(Request $request, Agenda $agenda): Response
    {
        $agenda->auditor = $request->get('auditor');
        return response(['saved' => $agenda->save()]);

    }
}
