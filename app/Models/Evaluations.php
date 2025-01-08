<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_session',
        'id_abilities',
        'id_per_initiator',
        'id_per_student',
        'id_status',
    ];
}
