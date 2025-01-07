<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    
    public function store(Request $request){
        $validated = $request->validate([
            
            'id_associate' => 'integer',
            'id_usertype' => 'integer',
            'date_beginning' => 'date',
            'date_ending' => 'date'
        ]);

        Formation::create($validated);

        return redirect()->back()->with('success', 'Formation ajoutée avec succès');

    }

}
