<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    public $table = 'skills';
    public $primary_key = 'id_skills';
    public $incrementing = true;
    public $timestamps = false;

    function selectAllTable(){
        $skills = skills::all()->sortBy('id_skills');
        return $skills;
    }

    function selectbyLevel($levelID){
        $skills = skills::where('id_level',$levelID)->orderby('id_skills')->get();
        return $skills;
    }
}
