<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Auditor extends Authenticatable
{
    use HasFactory, HasApiTokens;

    public function agendas(): HasMany
    {
        return $this->hasMany(Agenda::class, 'auditor');
    }

}
