<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    use HasFactory;

    protected $table = 'works';
    protected $filliable = ['id_sessions', 'id_abilities', 'id_per_student'];

    public $timestamps = false;

}