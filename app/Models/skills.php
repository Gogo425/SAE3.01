<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skills extends Model
{
    public $table = 'skills';
    public $primary_key = 'id';
    public $incrementing = true;
    public $timestamps = false;

    function selectAllTable(){
        $skills = skills::all()->sortBy('ID');
        return $skills;
    }

    function selectbyLevel($levelID){
        $skills = skills::where('ID_BELONG',$levelID)->orderby('ID')->get();
        return $skills;
    }
}
