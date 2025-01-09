<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
<<<<<<< HEAD
    
    protected $table = 'students';
    protected $filliable = ['id_per', 'id_level', 'id_formation'];

    public function user(){
        return $this->belongsTo(Persons::class);
    }
}
=======

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
>>>>>>> tablestudent
