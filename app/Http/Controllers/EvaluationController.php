<?php

namespace App\Http\Controllers;

use App\Models\Evaluations;
use App\Models\Students;
use App\Models\Session;
use App\Models\Abilities;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
{
    $eleves = Students::all(); // Liste des élèves
    $session = Session::all(); // Liste des sessions
    foreach ($session as $sessio) {
        dd($sessio->id_sessions, $sessio->id_location, $sessio->id_formation, $sessio->date_session);  // Remplacez 'id' et 'name' par les champs réels
    }
    $abilities = Abilities::all(); // Liste des compétences (abilités)

    return view('abilities_evaluation', compact('eleves', 'sessions', 'abilities'));
}

    public function store(Request $request)
    {
        
      

        
        Evaluations::create([
            'id_sessions'=> $request->session_id,
            'id_abilities' => $request->abilities_id,
            'id_per_student' => $request->eleve_id,
            'id_per_initiator' => auth()->id(), 
            'id_status' => $request->statut,
            'observations' => $request->observations
        
        ]);

        return redirect()->back()->with('success', 'Évaluation enregistrée avec succès.');
    }
}

