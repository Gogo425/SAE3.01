<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'formations';
    protected $fillable = ['id_formation','id_level','id_per_training_manager','date_beginning','date_ending','nom'];

    protected $primaryKey = 'id_formation'; 

    public $timestamps = false;

}


