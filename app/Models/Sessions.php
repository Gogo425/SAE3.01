<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;
    public $table = 'sessions';
    
    protected $fillable = ['id_sessions', 'id_location', 'id_formation', 'date_session'];


    //public $primary_key = 'ID_SESSIONS';
    //public $incrementing = true;
    public $timestamps = false;


}
