<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skills extends Model
{
    public $table = 'skills';
    protected $fillable = ['id_skills', 'id_level', 'description'];
    public $incrementing = true;
    public $timestamps = false;

    function display(){
        $skills = skills::all();
        return $skills;
    }
}
