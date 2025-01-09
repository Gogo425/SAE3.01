<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trains extends Model
{
    use HasFactory;

    protected $table = 'trains';
    protected $filliable = ['id_per_initiator', 'id_formation'];

    public $timestamps = false;

}