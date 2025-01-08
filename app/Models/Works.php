<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    use HasFactory;

    protected $table = 'works';
    protected $filliable = ['id', 'id_1', 'id_usertype'];

    public $timestamps = false;

}