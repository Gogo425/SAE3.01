<?php

namespace App\Http\Controllers;

use App\Models\Evaluations;
use App\Models\Students;
use App\Models\Sessions;
use App\Models\Abilities;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EvaluationController extends Controller
{
    // Displays the form to create an evaluation
    public function index(string $idSession)
    {
        
         //dd('idSession is an array:', $idSession);
        
        if (is_array($idSession)) {
            throw new Exception('idSession is an array, expected a string: ' . json_encode($idSession));
        }
        $initia =DB::table('persons')
        ->join('initiators', 'initiators.id_per', '=', 'initiators.id_per')
        ->select('initiators.id_per')
        ->get();

        $idPerArray = $initia->pluck('id_per')->toArray();

        if (in_array(Auth::id(), $idPerArray)) {
            // Hardcoded session ID (replace with dynamic session ID logic if needed)
            $id = $idSession;

            // Retrieve the list of students associated with the session
            $eleves = DB::table('persons')
            ->join('students', 'students.id_per', '=', 'persons.id_per')
            ->join('works', 'students.id_per', '=', 'works.id_per_student')
            ->where('works.id_sessions', '=', $id)
            ->where('works.id_per_initiator', '=', Auth::id())
            ->distinct()
            ->select('persons.id_per', 'persons.name', 'persons.surname') // Sélectionnez les colonnes nécessaires
            ->get();
        
        // Récupérez les compétences pour chaque élève
        $elevesWithAbilities = $eleves->map(function ($eleve) use ($id) {
            $eleve->abilities = DB::table('abilities')
                ->join('works', 'abilities.id_abilities', '=', 'works.id_abilities')
                ->where('works.id_sessions', '=', $id)
                ->where('works.id_per_student', '=', $eleve->id_per)
                ->where('works.id_per_initiator', '=', Auth::id())
                ->select('abilities.id_abilities', 'abilities.description')
                ->get();
        
            return $eleve;
        });
        
        // Récupérez les statuts disponibles
        $status = DB::table('status')->get();
        Log::info('go to view');
        
        // Passez les données à la vue
        return view('abilities_evaluation', [
            'eleves' => $elevesWithAbilities,
            'status' => $status,
            'idSession' => $idSession
        ]);
        }else{
            echo "Vous ne pouvez pas acceder a cette page";
        }
        
    }

    // Stores a new evaluation in the database
    public function store(Request $request)
{
    //dd($request->all());
    $idSession = $request->input('idSession');
    $eleve_ids = $request->input('id'); // Student IDs
    $statuses = $request->input('status'); // Statuses for abilities
    $observations = $request->input('observations'); // Observations

    try {
        foreach ($eleve_ids as $eleve_id => $value) {
            foreach ($statuses[$eleve_id] as $ability_id => $status_id) {
                DB::table('evaluations')->updateOrInsert(
                    [
                        'id_sessions' => $idSession,
                        'id_abilities' => $ability_id,
                        'id_per_student' => $eleve_id,
                    ],
                    [
                        'id_status' => $status_id,
                        'observations' => $observations[$eleve_id][$ability_id] ?? null,
                        'id_per_initiator' => Auth::id(),
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Évaluation enregistrée avec succès.');
    } catch (QueryException $e) {
        if ($e->getCode() === "23000") {
            return redirect()->back()->with('alert', 'Une ou plusieurs évaluations n\'ont pas pu être enregistrées à cause d\'une contrainte de clé étrangère.');
        }

        throw $e;
    }
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
