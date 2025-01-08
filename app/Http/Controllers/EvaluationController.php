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
    // Displays the form to create an evaluation
    public function index()
    {
        // Hardcoded session ID (replace with dynamic session ID logic if needed)
        $id = 1;

        // Retrieve the list of students associated with the session
        $eleves = DB::table('persons')
            ->join('students', 'students.id_per', '=', 'persons.id_per')
            ->join('formations', 'students.id_formation', '=', 'formations.id_formation')
            ->join('sessions', 'sessions.id_formation', '=', 'formations.id_formation')
            ->where('sessions.id_sessions', '=', $id)
            ->get();

        // Retrieve the abilities linked to the session
        $abilities = DB::table('abilities')
            ->join('works', 'abilities.id_abilities', '=', 'works.id_abilities')
            ->where('works.id_sessions', '=', $id)
            ->get();

        // Retrieve all available statuses
        $status = DB::table('status')->get();

        // Pass data to the evaluation creation view
        return view('abilities_evaluation', [
            'eleves' => $eleves,
            'abilities' => $abilities,
            'status' => $status
        ]);
    }

    // Stores a new evaluation in the database
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

    // Retrieves abilities for a specific student using AJAX
    public function getAbilitiesByStudent(Request $request)
    {
        // Get the ID of the selected student
        $eleve_id = $request->input('id_eleve');

        // Retrieve abilities linked to the student
        $abilities = DB::table('abilities')
            ->join('works', 'abilities.id_abilities', '=', 'works.id_abilities')
            ->where('works.id_per_student', '=', $eleve_id)
            ->select('abilities.id_abilities', 'abilities.description') // Only return necessary fields
            ->get();

        // Return the abilities as a JSON response
        return response()->json($abilities);
    }
}
