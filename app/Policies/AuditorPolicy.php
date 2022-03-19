<?php

namespace App\Policies;

use App\Models\Auditor;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AuditorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  Auditor  $identifiedAuditor
     * @param  Auditor  $auditor
     * @return Response
     */
    public function view(Auditor $identifiedAuditor, Auditor $auditor)
    {
        return $identifiedAuditor->id === $auditor->id
            ? Response::allow()
            : Response::deny(
                "You only can show your own profile."
            );
    }
}
