<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\Works;
use App\Models\Evaluations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Support\Arr;

class SeanceController extends Controller
{

    public function creation(string $date_session, /*int $form*/)
    {
        $d=mktime(11, 14, 54, 8, 12, 2025); //a supp quand params mit
        $date = date("Y-m-d", $d); //a supp quand les params mit
        $form = 2; //a supp quand les params mit

        $formations = DB::table('formations')->where('id_formation', $form)->get()->collect()->get('0');

        $students = DB::table('persons')->join('students', 'persons.id_per', '=', 'students.id_per')
                                        ->join('formations', 'formations.id_formation', '=', 'students.id_formation')
                                        ->where("students.id_formation", $form)->get();

                                        $abilities = array();

                                        $tabAbilities = DB::table('formations')->join('levels', 'formations.id_level', '=', 'levels.id_level')
                                                                                ->join('skills', 'skills.id_level', '=', 'levels.id_level')
                                                                                ->join('abilities', 'skills.id_skills', '=', 'abilities.id_skills')
                                                                                ->where("formations.id_formation", $form)->distinct('ID_ABILITIES')->get();
                                
                                
                                        foreach($students as $student) {
                                
                                            $studentAbilities = array();
                                
                                            $evaluation = new Evaluations();
                                
                                            foreach($tabAbilities as $abiliti) {
                                                $rep = $evaluation->getEvaluationsStudent($student->ID_PER, $abiliti->ID_ABILITIES);
                                                if(!$rep) {
                                                    array_push($studentAbilities, $abiliti);
                                                }
                                            }
                                
                                            array_push($abilities, $studentAbilities);
                                        }

        $initiators = DB::table('trains')->join('initiators', 'trains.id_per_initiator', '=', 'initiators.id_per')
                                          ->join('persons', 'persons.id_per', '=', 'initiators.id_per')
                                          ->where("id_formation", $form)->get();


        $locations = DB::table('locations')->get();

        return view('creationSeance', [
            'students' => $students,
            'abilities' => $abilities,
            'initiators' => $initiators,
            'locations' => $locations,
            'formations' => $formations,
            'date_session' => $date_session

        ]);
    }

    public function save(Request $request) {

        //dd($request->all());

        $sysdate = date("Y-m-d");
        if($sysdate >= $request->dateSession) {
            return redirect()->back()->with('failure', "la date est ultérieur à la date du jour, il n'est pas possible de faire une séance !");
        }
        
        $nb = ($request->collect()->count()-2)/5;

        $validatedSession = $request->validate([
            'id_location' => 'integer',
            'id_formation' => 'integer',
            'date_session' => 'date'
        ]);

        $validatedWorks = $request->validate([
            'id_sessions' => 'integer',
            'id_abilitites' => 'integer',
            'id_per_student' => 'integer'
        ]);

        $nbInitiator = array();

        for($i = 1; $i <= $nb; $i++){
            if($request->get('initiator'.$i) != null) {
                $initiator = DB::table('persons')->where('name', $request->get('initiator'.$i))->get()->collect()->get('0')->ID_PER;
                $initiatorName = DB::table('persons')->where('name', $request->get('initiator'.$i))->get()->collect()->get('0')->NAME;

                if(!array_key_exists($initiator, $nbInitiator)) {
                    $nbInitiator[$initiator] = 1;
                }
                else if($nbInitiator[$initiator] < 2) {
                    $nbInitiator[$initiator] += 1;
                }
                else if($nbInitiator[$initiator] >= 2) {
                    return redirect()->back()->with('failure', "l'initiateur ".$initiatorName." a plus de 2 élèves");
                }
            }
            
        }

        $exists = DB::table('sessions')->where('date_session', $request->dateSession)->exists();

        $idLocation = DB::table('locations')->where('type', $request->location)->get()->collect()->get('0')->ID_LOCATION;

        if($exists){
            return redirect()->back()->with('failure', "la séance existe déjà à cette date pour cette formation");
        }
        
        $session = new Sessions();
        $session->id_location = $idLocation;
        $session->id_formation = 2;//valeur fixe pour l'instant
        $session->date_session = $request->dateSession;
        $session->save();

        $idSession = DB::table('sessions')->where('date_session', $request->dateSession)->get()->collect()->get('0')->ID_SESSIONS;
        
        for($i = 1; $i <= $nb; $i++){
            $student = DB::table('persons')->where('name', $request->get('student'.$i))->get()->collect()->get('0')->ID_PER;

            if($request->get('initiator'.$i) != null) {

                $initiator = DB::table('persons')->where('name', $request->get('initiator'.$i))->get()->collect()->get('0')->ID_PER;

                $abilitie1Null = $request->get('abilities1'.$i);
                $abilitie2Null = $request->get('abilities2'.$i);
                $abilitie3Null = $request->get('abilities3'.$i);

                if(null !== $abilitie1Null){
                    $abilitie1 = DB::table('abilities')->where('description',$request->get('abilities1'.$i))->get()->collect()->get('0')->ID_ABILITIES;
                    $works = new Works();
                    $works->id_sessions = $idSession;
                    $works->id_per_student = $student;
                    $works->id_abilities = $abilitie1;
                    $works->id_per_initiator = $initiator;
                    $works->save();
                }

                if(null !== $abilitie2Null &&  $abilitie1Null != $abilitie2Null){
                    $abilitie2 = DB::table('abilities')->where('description',$request->get('abilities2'.$i))->get()->collect()->get('0')->ID_ABILITIES;
                    $works = new Works();
                    $works->id_sessions = $idSession;
                    $works->id_per_student = $student;
                    $works->id_abilities = $abilitie2;
                    $works->id_per_initiator = $initiator;
                    $works->save();
                }

                if(null !== $abilitie3Null && $abilitie1Null != $abilitie3Null && $abilitie2Null != $abilitie3Null){
                    $abilitie3 = DB::table('abilities')->where('description',$request->get('abilities3'.$i))->get()->collect()->get('0')->ID_ABILITIES;
                    $works = new Works();
                    $works->id_sessions = $idSession;
                    $works->id_per_student = $student;
                    $works->id_abilities = $abilitie3;
                    $works->id_per_initiator = $initiator;
                    $works->save();
                }
            }
            
        }

        return redirect()->route('calendar.calendarDirector')->with('success', 'Session ajoutée avec succès');

    }

}