<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    use HasFactory;

    protected $table = 'evaluations';

    protected $fillable = [
        'id_session',
        'id_abilities',
        'id_per_initiator',
        'ID_PER_STUDENT',
        'id_status',
        'observations'
    ];

    public $timestamps = false;


    function getObservation($session,$abiliti ,$student){
        $evals = evaluations::where('ID_SESSIONS',$session)->where('ID_PER_STUDENT',$student)->where('ID_ABILITIES', $abiliti)->get();
        return $evals;
    }

}
