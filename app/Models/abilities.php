<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class abilities extends Model
{
    public $table = 'abilities';
    public $primary_key = 'id';
    public $incrementing = true;
    public $timestamps = false;


    function selectAllTable(){
        $abilities = abilities::all()->sortBy('ID_LINKED');
        return $abilities;
    }

    function selectBySkill($skill){
        $abilities = abilities::where('ID_LINKED',$skill)->orderBy('ID', 'asc')->get();
        return $abilities;
    }

    function countBySkill($skill){
        $abilities = abilities::where('ID_LINKED',$skill)->count();
        return $abilities;
    }

}
