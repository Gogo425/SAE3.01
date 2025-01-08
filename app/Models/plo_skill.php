<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plo_skill extends Model
{
    public $table = 'plo_skills';
    public $primary_key = 'skills_id';
    public $incrementing = true;
    public $timestamps = false;

    function display(){
        $skills = plo_skill::all();
        return $skills;
    }
}
