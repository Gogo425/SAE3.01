<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingManager extends Model
{
    use HasFactory;

    protected $table = 'training_managers';
    protected $fillable = ['id_per'];

    public $timestamps = false;

}


