<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    public function tasks(){
        return $this->hasMany(Task::class, 'agenda');
    }

    public function auditor(){
        return $this->belongsTo(Auditor::class, 'auditor');
    }
}
