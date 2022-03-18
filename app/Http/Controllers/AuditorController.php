<?php

namespace App\Http\Controllers;

use App\Models\Auditor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuditorController extends Controller
{


    /**
     * Display the specified auditor.
     *
     * @param Auditor $auditor
     * @return Response
     */
    public function show(Auditor $auditor)
    {
        $this->authorize('view', $auditor);
        return response($auditor->fresh('agendas'));
    }

    public function showMe(Request $request)
    {
        return $this->show($request->user());
    }

    /**
     * Creates a new token for a valid (user & password) auditor.
     *
     * @param Request $request
     * @return Response
     */
    public function createToken(Request $request): Response
    {

        $authenticated = Auth::guard('auditors')->attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        if($authenticated)
        {
            $token = $request->user('auditors')->createToken($request->get('device'));
            return response(['token' => $token->plainTextToken]);
        }
        else
        {
            return response(['message' => 'Invalid credentials'], 401);
        }
    }

    /**
     * Deletes a valid auditor token.
     *
     * @param Request $request
     * @return Response
     */
    public function deleteToken(Request $request): Response
    {
        $message = ['status' => 'Failed to delete token'];
        if($request->user()->currentAccessToken()->delete())
        {
            $message['status'] = 'Success';
        }
        return response($message);
    }
}
