<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Persons;

class CreateFormController extends Controller
{

    public function create(){
        return view('creationFormation');
    }

    public function store(Request $request){
        $validated = $request->validate([
            
            'id_associate' => 'integer',
            'id_usertype' => 'integer',
            'date_beginning' => 'date',
            'date_ending' => 'date'
        ]);

        $person = Persons::where('mail_adress', $request->email)->first();

        $formation = new Formation();
        $formation->id_associate = $person->ID;
        $formation->id_usertype = $request->id_usertype;
        $formation->date_beginning = $request->date_beginning;
        $formation->date_ending = $request->date_ending;
        $formation->save();

        return redirect()->back()->with('success', 'Formation ajoutée avec succès');

    }

}
