<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Initiator;
use App\Models\Persons;
use App\Models\TrainingManager;
use App\Models\Trains;
use Illuminate\Support\Facades\DB;

class CreateFormController extends Controller
{

    public function create(){
        return view('creationFormation', [

            'initsLess' => DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->whereNotIn('initiators.id_per',function ($query){
                $query->select('id_per')->from('training_managers');
            })->get(),

            'inits' => DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->get(),

            'studs' => DB::table('students')->join('persons','students.id_per','=','persons.id_per')->get()

        ]);
    }
    

    public function store(Request $request){
        $validated = $request->validate([
            
            'id_per_training_manager' => 'integer',
            'id_level' => 'integer',
            'date_beginning' => 'date',
            'date_ending' => 'date',
        ]);

        $other = Persons::where('name', $request->name)->first();

        $person = Initiator::where('id_per',$other->ID_PER)->first();

        $manager = new TrainingManager();
        $manager->id_per = $person->ID_PER;
        $manager->save();

        $formation = new Formation();
        $formation->id_per_training_manager = $person->ID_PER;
        $formation->id_level = $request->id_level;
        $formation->date_beginning = $request->date_beginning;
        $formation->date_ending = $request->date_ending;
        $formation->save();

        $inits = DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->get();
        
        foreach($inits as $init){
            dd($request);
            if($request->$init->ID_PER == true){
                $train = new Trains();
                $train->id_per_initiator = $init->ID_PER;
                $train->id_formation = $formation->ID_FORMATION;
                $train->save();
            }
        }


        return redirect()->back()->with('success', 'Formation ajoutée avec succès');

    }

}
