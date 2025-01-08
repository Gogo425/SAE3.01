<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    public $table = 'abilities';

    protected $fillable = ['id_abilities', 'id_skills', 'description'];

    public $primary_key = 'id_abilities';
    public $incrementing = true;
    public $timestamps = false;


    function selectAllTable(){
        $abilities = abilities::all()->sortBy('id_skills');
        return $abilities;
    }

    function selectBySkill($skill){
        $abilities = abilities::where('id_skills',$skill)->orderBy('id_abilities', 'asc')->get();
        return $abilities;
    }

    function countBySkill($skill){
        $abilities = abilities::where('id_skills',$skill)->count();
        return $abilities;
    }

}