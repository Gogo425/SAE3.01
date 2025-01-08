<?php

namespace App\Http\Controllers;

use App\Models\Evaluations;
use App\Models\Students;
use App\Models\Session;
use App\Models\Abilities;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function index()
{

    $eleves = DB::table('students')->get(); // Liste des élèves
    $sessions =  DB::table('sessions')->get(); // Liste des sessions
    $abilities =  DB::table('abilities')->get(); // Liste des compétences (abilités)
    $status =  DB::table('status')->get();

    return view('abilities_evaluation', ['eleves' => $eleves, 'sessions'=> $sessions, 'abilities' =>$abilities  ,'status' =>$status]);
}

    public function store(Request $request)
    {
        dd($request->all());
      

        
        Evaluations::create([
            'id_sessions'=> $request->id_sessions,
            'id_abilities' => $request->abilities_id,
            'id_per_student' => $request->eleve_id,
            'id_per_initiator' => auth()->id(), 
            'id_status' => $request->statut,
            'observations' => $request->observations
        
        ]);

        return redirect()->back()->with('success', 'Évaluation enregistrée avec succès.');
    }
}

