<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sessions extends Model
{
    public $table = 'sessions';
    public $primary_key = 'id_abilities';
    public $incrementing = true;
    public $timestamps = false;

    function selectAllTable(){
        $abilities = sessions::all()->sortBy('DATE_SESSION');
        return $abilities;
    }

    function getByDate($date){
        $session = sessions::where('DATE_SESSION',$date)->select('ID_SESSIONS')->get();
        return $session;
    }
}
