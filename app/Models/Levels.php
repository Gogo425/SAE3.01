<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    use HasFactory;

    protected $table = 'levels';
    protected $fillable = ['id_formations', 'id_level', 'id_per_training_manager', 'date_beginning', 'date_ending', 'nom'];

    public $timestamps = false;
}
