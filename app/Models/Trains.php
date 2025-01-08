<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class Trains extends Model 
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'trains';
    protected $fillable = ['id_per_initiator','id_formation'];


}
