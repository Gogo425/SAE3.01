<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $filliable = ['id', 'id_locate', 'id_initialte', 'date_session'];

    public $timestamps = false;

}
