<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    use HasFactory;

    protected $table = 'abilities';
    protected $filliable = ['id_abilities', 'id_skills', 'description'];

    public $timestamps = false;

    function selectAllTable(){
        $abilities = abilities::all()->sortBy('ID_SKILLS');
        return $abilities;
    }
    function selectBySkill($skill){
        $abilities = abilities::where('ID_SKILLS',$skill)->orderBy('ID_ABILITIES', 'asc')->get();
        return $abilities;
    }
    function countBySkill($skill){
        $abilities = abilities::where('ID_SKILLS',$skill)->count();
        return $abilities;
    }
}