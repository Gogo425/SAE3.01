<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class Sessions extends Model 
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sessions';
    protected $fillable = ['id_sessions','id_location','id_formation','date_session'];


}
