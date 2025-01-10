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
     /**
     * Display lists of students, initiators, training managers, and persons to the link with the type persons.
     *
     * @return \Illuminate\View\View Returns the 'manage' view with data for users.
     */

    public function index()
    {
        
        // Retrieve students with their associated details
        $students = DB::table('students')
        ->join('persons', 'students.id_per', '=', 'persons.id_per')
        ->join('levels','students.id_level', '=', 'levels.id_level')
        ->select('students.*', 'persons.name', 'persons.surname', 'persons.email','persons.licence_number','persons.medical_certificate_date','persons.birth_date','persons.adress','levels.description','students.id_formation','levels.id_level')
        ->get();


      
        // Retrieve initiators with their associated details
        $initiators = DB::table('initiators')->join('persons', 'initiators.ID_PER', '=', 'persons.ID_PER')
        ->join('levels','initiators.id_level', '=', 'levels.id_level')
        ->leftJoin('training_managers', 'training_managers.ID_PER', '=', 'persons.ID_PER') 
        ->leftJoin('technical_directors', 'technical_directors.ID_PER', '=', 'persons.ID_PER') 
        ->whereNull('training_managers.ID_PER') 
        ->whereNull('technical_directors.ID_PER') 
        ->select('initiators.*', 'persons.name', 'persons.surname', 'persons.email','persons.licence_number','persons.medical_certificate_date','persons.birth_date','persons.adress','levels.description', 'levels.id_level')
        ->get();

         // Retrieve all persons
        $persons = DB::table('persons')->get();

        // Retrieve training managers with their associated details
        $training_managers = DB::table('training_managers')
        ->join('initiators', 'initiators.ID_PER', '=', 'training_managers.ID_PER')
        ->join('persons', 'initiators.ID_PER', '=', 'persons.ID_PER')
        ->join('levels','initiators.id_level', '=', 'levels.id_level')
        ->select('training_managers.*', 'persons.name', 'persons.surname', 'persons.email','persons.licence_number','persons.medical_certificate_date','persons.birth_date','persons.adress','levels.description','levels.id_level')
        ->get();

         //dd($training_managers);

    

    
    return view('manage', ['students' => $students,  'initiators' => $initiators, 'persons' => $persons, 'training_managers' => $training_managers ]);

    }

      /**
     * Delete a student by their ID.
     *
     * @param int $ID_PER The student's ID.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */

    public function manageDeleteStudent($ID_PER) {
        $student = Students::where('ID_PER', $ID_PER)->firstOrFail();
        $student->delete();
        return redirect()->back()->with('success', 'Élève supprimé avec succès.');
    }


      /**
     * Delete an initiator by their ID.
     *
     * @param int $ID_PER The initiator's ID.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */

    public function manageDeleteInitiator($ID_PER) {
        $initiators = Initiators::where('ID_PER', $ID_PER)->firstOrFail();
        $initiators->delete();
        return redirect()->back()->with('success', 'Initiateur supprimé avec succès.');
    }

      /**
     * Delete a training manager by their ID.
     *
     * Handles cascading deletions for associated formations, sessions, and evaluations.
     *
     * @param int $ID_PER The training manager's ID.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */

    public function manageDeleteTrainingManager($ID_PER) {

       $id_formation =  DB::table('formations')->where('ID_PER_TRAINING_MANAGER', $ID_PER)->select('ID_FORMATION')->first();
       if ($id_formation) {
            if($id_formation->ID_FORMATION != null){
                    DB::table('students')->where('id_formation',$id_formation->ID_FORMATION)->update(['id_formation' => null]);
                    DB::table('trains')->where('id_formation',$id_formation->ID_FORMATION)->delete();
            }
            $id_session =  DB::table('sessions')->where('id_sessions', $id_formation->ID_FORMATION)->select('ID_SESSIONS')->first();
            if($id_session != null){
                    DB::table('works')->where('id_sessions', $id_session->ID_SESSIONS)->delete();
                    DB::table('evaluations')->where('id_sessions', $id_session->ID_SESSIONS)->delete();
            }
            if($id_formation->ID_FORMATION != null){
                    DB::table('sessions')->where('id_formation',$id_formation->ID_FORMATION)->delete();
                    DB::table('formations')->where('id_formation',$id_formation->ID_FORMATION)->delete();
            }
       }
      
       DB::table('training_managers')->where('id_per',$ID_PER)->delete();
       

    
        return redirect()->back()->with('success', 'Responsable Formation supprimé avec succès.');
    }


    /**
     * Display the edit form for a user.
     *
     * Retrieves user details, their current level (if a student or initiator), and all available levels.
     *
     * @param int $ID_PER The user's ID.
     * @return \Illuminate\View\View Returns the 'edit' view with user data.
     */

    public function editUser($ID_PER)
{
    // Recupe the persons informations
    $user = DB::table('persons')->where('ID_PER', $ID_PER)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Personne introuvable.');
    }

    // check if it's a student
    $studentLevel = DB::table('students')
        ->join('levels', 'students.id_level', '=', 'levels.id_level')
        ->select('levels.description', 'levels.id_level')
        ->where('students.ID_PER', $ID_PER)
        ->first();

    // check if it's a initiator
    $initiatorLevel = DB::table('initiators')
        ->join('levels', 'initiators.id_level', '=', 'levels.id_level')
        ->select('levels.description', 'levels.id_level')
        ->where('initiators.ID_PER', $ID_PER)
        ->first();

    // Recup all levels
    $levels = DB::table('levels')->get();

    //find the levels of the current person
    $currentLevel = null;
    if ($studentLevel) {
        $currentLevel = $studentLevel; //level student
    } elseif ($initiatorLevel) {
        $currentLevel = $initiatorLevel; // level initiator
    }

    //dd($currentLevel);

    return view('edit', [
        'user' => $user,
        'levels' => $levels,
        'currentLevel' => $currentLevel,
    ]);
}



    public function updateUser(Request $request, $ID_PER){
    // Validation datas
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:persons,email,' . $ID_PER . ',ID_PER', 
            'adress' => 'nullable|string|max:255',
            'medical_certificate_date' => 'required|date',
            'birth_date' => 'required|date',
            'licence_number' => ['required', 
            'regex:/^A-\d{2}-\d{6}$/',
            ],
            'level_id' => 'required|exists:levels,id_level',
        ]);

        //dd($validatedData);

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


            //insert a new level if its a student
            $student = DB::table('students')->where('ID_PER', $ID_PER)->first();
            if ($student != null) {
                DB::table('students')->where('ID_PER', $ID_PER)->update([
                    'id_level' => $validatedData['level_id'],
                ]);
            }
            
            //insert a new level if its a initiator
            $initiator = DB::table('initiators')->where('ID_PER', $ID_PER)->first();
    
            if ($initiator != null) {
                DB::table('initiators')->where('ID_PER', $ID_PER)->update([
                    'id_level' => $validatedData['level_id'],
                ]);
            }


           

        return redirect()->route('liste');
}

}
    

