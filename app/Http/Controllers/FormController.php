<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Persons;
use App\Models\Trains;
use App\Models\Initiator;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{

    public function create(){
        return view('formation', [
            'forms' => DB::table('formations')->get(),

            'inits' => DB::table('initiators')->join('trains','initiators.id_per','=','trains.id_per_initiator')->join('persons','initiators.id_per','=','persons.id_per')->get(),

            'pers' => DB::table('persons')->get(),

            'studs' => DB::table('students')->join('persons','students.id_per','=','persons.id_per')->get(),

            'sessions' => DB::table('sessions'),

            'nbFormations' => DB::table('formations')->count('id_formation')
        ]);
    }

    public function deleteFormation($ID_FORMATION){
        DB::table('students')->where('id_formation',$ID_FORMATION)->update(['id_formation' => null]);
        DB::table('trains')->where('id_formation',$ID_FORMATION)->delete();
        $id = DB::table('formations')->where('id_formation',$ID_FORMATION)->get();
        DB::table('formations')->where('id_formation',$ID_FORMATION)->delete();
        DB::table('training_managers')->where('id_per',$id->first()->ID_PER_TRAINING_MANAGER)->delete();
        return redirect()->back()->with('success', 'Formation supprimée avec succès');
    }

    public function getStudentsAndInitators() {
        $idFormation = DB::table('formations')->join('training_managers','formations.id_per_training_manager','=','training_managers.id_per')->get()->first()->ID_FORMATION;

        $students = DB::table('persons')->join('students','persons.id_per','=','students.id_per')->where('students.id_formation',$idFormation)->get();

        $initiators = DB::table('persons')->join('initiators','persons.id_per','=','initiators.id_per')->join('trains','initiators.id_per','=','trains.id_per_initiator')->where('trains.id_formation',$idFormation)->get();

        //dd($idFormation, $students, $initiators);
        return view('listUsersInitiators', [
            'students' => $students,
            'initiators' => $initiators
        ]);
    }

}
