<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    use HasFactory;

    protected $table = 'abilities';
    protected $filliable = ['id_abilities', 'id_skills', 'description'];

    public $timestamps = false;

}