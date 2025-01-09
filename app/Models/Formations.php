<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    use HasFactory;

    protected $table = 'formations';
    protected $filliable = ['id_formation', 'id_level', 'id_per_training_manager', 'date_beginning', 'date_ending', 'nom'];

    public $timestamps = false;

}