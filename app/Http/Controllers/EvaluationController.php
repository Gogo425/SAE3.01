<?php

namespace App\Http\Controllers;

use App\Models\Evaluations;
use App\Models\Students;
use App\Models\Sessions;
use App\Models\Abilities;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
{
    $eleves = Students::all(); // Liste des élèves
    $sessions = Sessions::all(); // Liste des sessions
    foreach ($sessions as $session) {
        dd($session->id_sessions, $session->id_location, $session->id_formation, $session->date_session);  // Remplacez 'id' et 'name' par les champs réels
    }
    $abilities = Abilities::all(); // Liste des compétences (abilités)

    return view('abilities_evaluation', compact('eleves', 'sessions', 'abilities'));
}

    public function store(Request $request)
    {
        
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'statut' => 'required|in:Évalué,Pas acquis',
        ]);

        
        Evaluations::create([
            'id_session'=> $request->session_id,
            'id_abilities' => $request->abilities_id,
            'id_per_student' => $request->eleve_id,
            'id_per_initiator' => auth()->id(), 
            'id_status' => $request->statut,
            'observations' => $request->observations
        
        ]);

        return redirect()->back()->with('success', 'Évaluation enregistrée avec succès.');
    }
}

