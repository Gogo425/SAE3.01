<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    
    protected $fillable = [
        'id_sessions',
        'id_abilities',
        'id_per_initiator',
        'id_per_student',
        'id_status',
        'observations'
    ];
    
    public $timestamps = false;
}
