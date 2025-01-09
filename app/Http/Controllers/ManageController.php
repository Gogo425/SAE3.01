<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Initiators;
use App\Models\Persons;
use App\Models\Training_managers;
use Illuminate\Support\Facades\DB;

class ManageController extends Controller
{
    public function index()
    {
        
        $students = DB::table('students')
        ->join('persons', 'students.id_per', '=', 'persons.id_per')
        ->join('levels','students.id_level', '=', 'levels.id_level')
        ->select('students.*', 'persons.name', 'persons.surname', 'persons.email','persons.licence_number','persons.medical_certificate_date','persons.birth_date','persons.adress','levels.description','students.id_formation','levels.id_level')
        ->get();



      
        
        $initiators = DB::table('initiators')->join('persons', 'initiators.ID_PER', '=', 'persons.ID_PER')
        ->join('levels','initiators.id_level', '=', 'levels.id_level')
        ->leftJoin('training_managers', 'training_managers.ID_PER', '=', 'persons.ID_PER') 
        ->leftJoin('technical_directors', 'technical_directors.ID_PER', '=', 'persons.ID_PER') 
        ->whereNull('training_managers.ID_PER') 
        ->whereNull('technical_directors.ID_PER') 
        ->select('initiators.*', 'persons.name', 'persons.surname', 'persons.email','persons.licence_number','persons.medical_certificate_date','persons.birth_date','persons.adress','levels.description', 'levels.id_level')
        ->get();

        $persons = DB::table('persons')->get();

        $training_managers = DB::table('training_managers')
        ->join('initiators', 'initiators.ID_PER', '=', 'training_managers.ID_PER')
        ->join('persons', 'initiators.ID_PER', '=', 'persons.ID_PER')
        ->join('levels','initiators.id_level', '=', 'levels.id_level')
        ->select('training_managers.*', 'persons.name', 'persons.surname', 'persons.email','persons.licence_number','persons.medical_certificate_date','persons.birth_date','persons.adress','levels.description','levels.id_level')
        ->get();

         //dd($training_managers);

    

    
    return view('manage', ['students' => $students,  'initiators' => $initiators, 'persons' => $persons, 'training_managers' => $training_managers ]);

    }

    public function manageDeleteStudent($ID_PER) {
        $student = Students::where('ID_PER', $ID_PER)->firstOrFail();
        $student->delete();
        return redirect()->back()->with('success', 'Élève supprimé avec succès.');
    }

    public function manageDeleteInitiator($ID_PER) {
        $initiators = Initiators::where('ID_PER', $ID_PER)->firstOrFail();
        $initiators->delete();
        return redirect()->back()->with('success', 'Initiateur supprimé avec succès.');
    }

    public function manageDeleteTrainingManager($ID_PER) {
        DB::table('formations')
        ->where('ID_PER_TRAINING_MANAGER', $ID_PER)
        ->delete();
        $training_managers =  DB::table('training_managers')->where('ID_PER', $ID_PER)->delete();
        return redirect()->back()->with('success', 'Responsable Formation supprimé avec succès.');
    }


    public function editUser($ID_PER)
{
    // Récupérer les informations de la personne
    $user = DB::table('persons')->where('ID_PER', $ID_PER)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Personne introuvable.');
    }

    // Vérifier si c'est un étudiant
    $studentLevel = DB::table('students')
        ->join('levels', 'students.id_level', '=', 'levels.id_level')
        ->select('levels.description', 'levels.id_level')
        ->where('students.ID_PER', $ID_PER)
        ->first();

    // Vérifier si c'est un initiateur
    $initiatorLevel = DB::table('initiators')
        ->join('levels', 'initiators.id_level', '=', 'levels.id_level')
        ->select('levels.description', 'levels.id_level')
        ->where('initiators.ID_PER', $ID_PER)
        ->first();

    // Récupérer tous les niveaux disponibles
    $levels = DB::table('levels')->get();

    // Déterminer le niveau à afficher
    $currentLevel = null;
    if ($studentLevel) {
        $currentLevel = $studentLevel; // Niveau étudiant
    } elseif ($initiatorLevel) {
        $currentLevel = $initiatorLevel; // Niveau initiateur
    }

    //dd($currentLevel);

    return view('edit', [
        'user' => $user,
        'levels' => $levels,
        'currentLevel' => $currentLevel,
    ]);
}



    public function updateUser(Request $request, $ID_PER){
    // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:persons,email,' . $ID_PER . ',ID_PER', 
            'adress' => 'nullable|string|max:255',
            'medical_certificate_date' => 'required|date',
            'birth_date' => 'required|date',
            'licence_number' => ['required', 
            'regex:/^[A-Z]-\d{2}-\d{6}$/',
            ],
            'id_level' => 'required|exists:levels,ID_LEVEL',
        ]);

        dd($validatedData);

        DB::table('persons')
            ->where('ID_PER', $ID_PER)
            ->update([
                'name' => $validatedData['name'],
                'surname' => $validatedData['surname'],
                'email' => $validatedData['email'],
                'adress' => $validatedData['adress'],
                'medical_certificate_date' => $validatedData['medical_certificate_date'],
                'birth_date' => $validatedData['birth_date'],
                'licence_number' =>$validatedData['licence_number'],
            ]);


            $student = DB::table('students')->where('ID_PER', $ID_PER)->first();
            if ($student) {
                DB::table('students')->where('ID_PER', $ID_PER)->update([
                    'id_level' => $validatedData['level_id'],
                ]);
            }
        
            $initiator = DB::table('initiators')->where('ID_PER', $ID_PER)->first();
            if ($initiator) {
                DB::table('initiators')->where('ID_PER', $ID_PER)->update([
                    'id_level' => $validatedData['level_id'],
                ]);
            }

        return view('manage')->with('success', 'Informations modifiées avec succès.');
}

}
    

