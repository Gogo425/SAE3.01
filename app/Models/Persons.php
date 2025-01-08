<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persons extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'id_per',
        'name',
        'surname',
        'password',
        'email',
        'licence_number',
        'medical_certificate_date',
        'birth_date',
        'adress'
    ];

    public $timestamps = false;

    function selectAllTable(){
        $persons = persons::all()->sortBy('ID_PER');
        return $persons;
    }
    function getNameOf($id){
        $name = persons::where('ID_PER',$id)->select('NAME','SURNAME')->get();
        return $name[0]->NAME." ".$name[0]->SURNAME;
        
    }
}
