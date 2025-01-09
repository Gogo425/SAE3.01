<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    protected $filliable = ['id_sessions', 'id_abilities', 'id_per_initiator', 'id_per_student','id_status', 'observations'];

    public $timestamps = false;

    function getEvaluationsStudent($idStudent, $abiliti){

        $obeservations = Evaluations::where('ID_PER_STUDENT',$idStudent)->where('ID_ABILITIES',$abiliti)->get();

        $idStatus = [];
        foreach($obeservations as $ob){
            array_push($idStatus, $ob->ID_STATUS);
        }
        $nb = 0;
        foreach($idStatus as $statu){
            if($statu == 3){
                $nb = $nb+1;
            }else{
                $nb = 0;
            }
            if($nb == 3){
                return true;
            }
        }
        return false;
    }

}