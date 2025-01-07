<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sessions extends Model
{
    public $table = 'sessions';
    public $primary_key = 'id';
    public $incrementing = true;
    public $timestamps = false;

    function selectAllTable(){
        $abilities = sessions::all()->sortBy('date_session');
        return $abilities;
    }
    function selectAllDate(){
        $abilities = sessions::all()->sortBy('date_session');
        return $abilities;
    }
}
