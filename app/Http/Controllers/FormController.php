<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Import of the different models
use App\Models\Formation;
use App\Models\Persons;
use App\Models\Trains;
use App\Models\Initiator;

/**
 * It's the controlsler for the formations
 * @author @hugotheault
 */
class FormController extends Controller
{
    /**
     * Displays formations by showing the view
     * @return view the view of formations
     * @author @hugotheault
     */
    public function create(){
        return view('formation', [
            
            // The list of formations
            'forms' => DB::table('formations')->get(),

            // The list of initiators join with their identification in the table 'persons'
            'inits' => DB::table('initiators')->join('trains','initiators.id_per','=','trains.id_per_initiator')->join('persons','initiators.id_per','=','persons.id_per')->get(),
            
            // The list of persons
            'pers' => DB::table('persons')->get(),

            // The list of students join with their identification in the table 'persons'
            'studs' => DB::table('students')->join('persons','students.id_per','=','persons.id_per')->get(),

            // The list of sessions
            'sessions' => DB::table('sessions'),

            // The number of formations in the database (max = 3)
            'nbFormations' => DB::table('formations')->count('id_formation')
        ]);
    }

    /**
     * Allows you to delete a formation
     * @return redirect htttp answer that redirect the user to the previous page with a success message 
     * @param $ID_FORMATION the id of the formation you want to delete 
     * @author @hugotheault
     */
    public function deleteFormation($ID_FORMATION){

        // Update the id_formation column in the students table to null in order to delete the formation
        DB::table('students')->where('id_formation',$ID_FORMATION)->update(['id_formation' => null]);

        // Delete the line in the trains table in order to delete the formation
        DB::table('trains')->where('id_formation',$ID_FORMATION)->delete();

        // Retrieves the formation that has $ID_FORMATION as its id_formation and assigns it to the $id variable
        $id = DB::table('formations')->where('id_formation',$ID_FORMATION)->get();

        // Delete the line in the formations table
        DB::table('formations')->where('id_formation',$ID_FORMATION)->delete();

        // Delete the training manager in the training_managers table
        DB::table('training_managers')->where('id_per',$id->first()->ID_PER_TRAINING_MANAGER)->delete();

        return redirect()->back()->with('success', 'Formation supprimée avec succès');
    }

}
