<?php

namespace App\Http\Controllers;

use App\Models\Evaluations;
use App\Models\Students;
use App\Models\Sessions;
use App\Models\Abilities;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
        //dd($request->all());
        // Get the statuses and observations for each ability
        $eleve_id = $request->input('id_eleve');
        $statuses = $request->input('status');
        $observations = $request->input('observations');
       
        try{
        // Get the statuses and observations for each ability
        foreach ($statuses as $ability_id => $status_id) {
            $evaluation = DB::table('evaluations')
            ->where('id_sessions', 1) // session id (replace)
                ->where('id_abilities', $ability_id)
                ->where('id_per_student', $eleve_id)
                ->where('id_per_initiator', 2) // initiator id (replace)
                ->first();

            if ($evaluation) {
        
                DB::table('evaluations')
                ->where('id_abilities', $ability_id)
                ->where('id_per_student', $eleve_id)
                ->where('id_per_initiator', 2)
                ->update([
                    'id_status' => $status_id,
                    'observations' => isset($observations[$ability_id]) ? $observations[$ability_id] : null,
                ]);
            } else {
            Evaluations::create([
                'id_sessions' => 1,  // Hardcoded session ID (replace with dynamic logic if needed)
                'id_abilities' => $ability_id, // ID of the ability
                'id_per_student' => $eleve_id, // ID of the selected student
                'id_per_initiator' => 2, // Hardcoded initiator ID (e.g., teacher's ID)
                'id_status' => $status_id, // Status for the ability
                'observations' => isset($observations[$ability_id]) ? $observations[$ability_id] : null, // Optional observation
            ]);
        }
    }
    }catch (QueryException $e) {
        // Check if it's a foreign key constraint violation
        if ($e->getCode() === "23000") {
            // Redirect with an alert message
            return redirect()->back()->with('alert', 'Une ou plusieurs évaluations n\'ont pas pu être enregistrées à cause d\'une contrainte de clé étrangère.');
        }

        // Rethrow other database errors if needed
        throw $e;
    }

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
