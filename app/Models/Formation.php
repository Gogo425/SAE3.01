<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'formations';
    protected $fillable = ['id','id_associate','id_usertype','date_beginning','date_ending'];

    public $timestamps = false;

}


