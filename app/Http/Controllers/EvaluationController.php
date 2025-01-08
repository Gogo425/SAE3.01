<?php

namespace App\Http\Controllers;

use App\Models\Evaluations;
use App\Models\Students;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        
        $eleves = Students::all();
        return view('evaluations.index', compact('eleves'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'statut' => 'required|in:Évalué,Pas acquis',
        ]);

        
        Evaluations::create([
            'id_per_student' => $request->eleve_id,
            'id_per_initiator' => auth()->id(), 
            'id_status' => $request->statut,
        ]);

        return redirect()->back()->with('success', 'Évaluation enregistrée avec succès.');
    }
}

