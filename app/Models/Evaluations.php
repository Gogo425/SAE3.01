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
        $evals = Evaluations::where('ID_SESSIONS',$session)->where('ID_PER_STUDENT',$student)->where('ID_ABILITIES', $abiliti)->get();
        return $evals;
    }
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