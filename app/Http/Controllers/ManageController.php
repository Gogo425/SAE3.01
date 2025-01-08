<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Initiators;
use App\Models\Persons;
use Illuminate\Support\Facades\DB;

class ManageController extends Controller
{
    public function index()
    {
        
        $students = DB::table('students')
        ->join('persons', 'students.id_per', '=', 'persons.id_per')
        ->select('students.*', 'persons.name', 'persons.surname', 'persons.email')
        ->get();

        //dd($students);
        
        $initiators = DB::table('initiators')->join('persons', 'initiators.ID_PER', '=', 'persons.ID_PER')
        ->select('initiators.*', 'persons.name', 'persons.surname', 'persons.email')
        ->get();
        $persons = DB::table('persons')->get();

        

        
    
    return view('manage', ['students' => $students,  'initiators' => $initiators, 'persons' => $persons]);

    }

    public function manageDeleteStudent($ID_PER) {
        $student = Students::where('ID_PER', $ID_PER)->firstOrFail();
        $student->delete();
        return redirect()->back()->with('success', 'Élève supprimé avec succès.');
    }

    public function manageDeleteInitiator($ID_PER) {
        $initiators = Initiators::where('ID_PER', $ID_PER)->firstOrFail();
        $initiators->delete();
        return redirect()->back()->with('success', 'Élève supprimé avec succès.');
    }

    public function manageDeleteTrainingManager($ID_PER) {
        $initiators = Initiators::where('ID_PER', $ID_PER)->firstOrFail();
        $initiators->delete();
        return redirect()->back()->with('success', 'Élève supprimé avec succès.');
    }
    
    
}
