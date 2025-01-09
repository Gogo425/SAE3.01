<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Import of the different models
use App\Models\Formation;
use App\Models\Initiator;
use App\Models\Persons;
use App\Models\TrainingManager;
use App\Models\Trains;
use App\Models\Sessions;

/**
 * It's the controller for the creation of formations
 * @author @hugotheault
 */
class CreateFormController extends Controller
{

    /**
     * Display the form to create a formation
     * @return view the page to create a formation
     * @author @hugotheault
     */
    public function create(){
        return view('creationFormation', [

            // The list of initiators that are not already a training manager and that are not already an initiator in a formation
            'initsLess' => DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->whereNotIn('initiators.id_per',function ($query){
                $query->select('training_managers.id_per')->from('training_managers');
            })->whereNotIn('initiators.id_per',function ($query){
                $query->select('trains.id_per_initiator')->from('trains');
            })->get(),

            // The list of initiators that are not already a training manager and that are not already an initiator in a formation
            // possibly useless ? had to change it ?
            'inits' => DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->whereNotIn('initiators.id_per',function ($query){
                $query->select('trains.id_per_initiator')->from('trains');
            })->whereNotIn('initiators.id_per', function ($query){
                $query->select('training_managers.id_per')->from('training_managers');
            })->get(),
            
            // The list of students that are not already in a formation join their identification in the table 'persons'
            'studs' => DB::table('students')->join('persons','students.id_per','=','persons.id_per')->where('students.id_formation',null)->get(),

            // The formation where the column 'id_level' is equal to 2, 3 or 4
            'forma1' => DB::table('formations')->where('id_level',2)->first(),
            'forma2' => DB::table('formations')->where('id_level',3)->first(),
            'forma3' => DB::table('formations')->where('id_level',4)->first()

        ]);
    }
    
    /**
     * Permit the insertion in the database to create a formation
     * @return redirect htttp answer that redirect the user to the 'formation' page with a success message 
     * @param Request $request what we get back from the form
     * @author @hugotheault
     */
    public function store(Request $request){

        // The request that been receive by the form
        $validated = $request->validate([
            'id_per_training_manager' => 'integer',
            'id_level' => 'integer',
            'date_beginning' => 'date',
            'date_ending' => 'date',
        ]);

        // Create the new training manager with an initiator
        $other = Persons::where('name', $request->name)->first();
        $person = Initiator::where('id_per',$other->ID_PER)->first();
        $manager = new TrainingManager();
        $manager->id_per = $person->ID_PER;
        $manager->save();

        // Creation of a formation
        $formation = new Formation();
        $formation->id_per_training_manager = $person->ID_PER;
        $formation->id_level = $request->id_level+1;
        $formation->date_beginning = $request->date_beginning;
        $formation->date_ending = $request->date_ending;
        $formation->save();

        // Retrieves the formation with the biggest 'id_formation'
        $maxForma = DB::table('formations')->orderBy('id_formation','DESC')->get();

        // Adding the selected training initiators
        foreach($request->inits as $init){
            $trains = new Trains();
            $trains->id_per_initiator = $init;
            $trains->id_formation = $maxForma->first()->ID_FORMATION;
            $trains->save();
        }

        // Update the 'students' table to match the 'id_formation' column with the id of the formation where they were added
        foreach($request->studs as $stud){
            DB::table('students')->where('id_per','=',$stud)->update(['id_formation'=> $maxForma->first()->ID_FORMATION]);
        }

        return redirect()->route('formation')->with('success', 'Formation ajoutée avec succès');
    }

}
