<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\Works;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;

class seanceController extends Controller
{

    public function creation()
    {

        $id_formation = 1;

        $formations = DB::table('formations')->where('id_formation', $id_formation)->get();
        $students = DB::table('persons')->join('students', 'persons.id_per', '=', 'students.id_per')->join('formations', 'formations.id_formation', '=', 'students.id_formation')->get();
        $abilities = DB::table('abilities')->get();
        $initiators = DB::table('persons')->join('initiators', 'persons.id_per', '=', 'initiators.id_per')->get();
        $locations = DB::table('locations')->get();
        //dd($locations);
        //dd($initiators);
        //dd($abilities);
        //dd($students);

        return view('creationSeance', [
            'students' => $students,
            'abilities' => $abilities,
            'initiators' => $initiators,
            'locations' => $locations,
            'formations' => $formations
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

        $exists = DB::table('sessions')->where('date_session', $request->dateSession)->exists();

        $idLocation = DB::table('locations')->where('type', $request->location)->get()->collect()->get('0')->ID_LOCATION;

        if($exists){
            return redirect()->back()->with('failure', "la séance existe déjà à cette date pour cette formation");
        }
        
        $session = new Sessions();
        $session->id_location = $idLocation;
        $session->id_formation = 1;//valeur fixe pour l'instant
        $session->date_session = $request->dateSession;
        $session->save();

        $idSession = DB::table('sessions')->where('date_session', $request->dateSession)->get()->collect()->get('0')->ID_SESSIONS;
        
        for($i = 1; $i <= $nb; $i++){
            $student = DB::table('persons')->where('name', $request->get('student'.$i))->get()->collect()->get('0')->ID_PER;
            $initiator = DB::table('persons')->where('name', $request->get('initiator'.$i))->get()->collect()->get('0')->ID_PER;

            $abilitie1 = DB::table('abilities')->where('description',$request->get('abilities1'.$i))->get()->collect()->get('0')->ID_ABILITIES;
            $abilitie2 = DB::table('abilities')->where('description',$request->get('abilities2'.$i))->get()->collect()->get('0')->ID_ABILITIES;
            $abilitie3 = DB::table('abilities')->where('description',$request->get('abilities3'.$i))->get()->collect()->get('0')->ID_ABILITIES;

            if(null !== $abilitie1){
                $works = new Works();
                $works->id_sessions = $idSession;
                $works->id_per_student = $student;
                $works->id_abilities = $abilitie1;
                $works->id_per_initiator = $initiator;
                $works->save();
            }

            if(null !== $abilitie2 &&  $abilitie1 != $abilitie2){
                $works = new Works();
                $works->id_sessions = $idSession;
                $works->id_per_student = $student;
                $works->id_abilities = $abilitie2;
                $works->id_per_initiator = $initiator;
                $works->save();
            }

            if(null !== $abilitie3 && $abilitie1 != $abilitie3 && $abilitie2 != $abilitie3){
                $works = new Works();
                $works->id_sessions = $idSession;
                $works->id_per_student = $student;
                $works->id_abilities = $abilitie3;
                $works->id_per_initiator = $initiator;
                $works->save();
            }
            
        }

        return redirect()->back()->with('success', 'Session ajoutée avec succès');

    }

}