<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'id_per',
        'id_level',
        'id_formation'
    ];
    public $timestamps = false;
    function selectAllTable(){
        $persons = students::all()->sortBy('ID_PER');
        return $persons;
    }
    function selectByLevel($level){
        $persons = students::where('ID_LEVEL',$level)->get();
        return $persons;
    }
}
