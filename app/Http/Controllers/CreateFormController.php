<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Initiator;
use App\Models\Persons;
use App\Models\TrainingManager;

class CreateFormController extends Controller
{

    public function create(){
        return view('creationFormation');
    }

    public function store(Request $request){
        $validated = $request->validate([
            
            'id_per_training_manager' => 'integer',
            'id_level' => 'integer',
            'date_beginning' => 'date',
            'date_ending' => 'date',
            'nom' => 'text'
        ]);

        $other = Persons::where('email', $request->email)->first();
        $person = Initiator::where('id_per',$other->ID_PER)->first();

        $manager = new TrainingManager();
        $manager->id_per = $person->ID_PER;
        $manager->save();
        
        $formation = new Formation();
        $formation->id_per_training_manager = $person->ID_PER;
        $formation->id_level = $request->id_level;
        $formation->date_beginning = $request->date_beginning;
        $formation->date_ending = $request->date_ending;
        $formation->nom = $request->nom;
        $formation->save();

        return redirect()->back()->with('success', 'Formation ajoutée avec succès');

    }

}
