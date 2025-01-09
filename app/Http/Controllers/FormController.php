<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Persons;
use App\Models\Trains;
use App\Models\Initiator;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{

    public function create(){
        return view('formation', [
            'forms' => DB::table('formations')->get(),

            'inits' => DB::table('initiators')->join('trains','initiators.id_per','=','trains.id_per_initiator')->join('persons','initiators.id_per','=','persons.id_per')->get(),

            'pers' => DB::table('persons')->get(),

            'studs' => DB::table('students')->join('persons','students.id_per','=','persons.id_per')->get(),

            'sessions' => DB::table('sessions')
        ]);
    }

    public function deleteFormation($ID_FORMATION){
        DB::table('students')->where('id_formation',$ID_FORMATION)->update(['id_formation' => 1]);
        DB::table('trains')->where('id_formation',$ID_FORMATION)->delete();
        $id = DB::table('formations')->where('id_formation',$ID_FORMATION)->get();
        DB::table('formations')->where('id_formation',$ID_FORMATION)->delete();
        DB::table('training_managers')->where('id_per',$id->first()->ID_PER_TRAINING_MANAGER)->delete();
        return redirect()->back()->with('success', 'Formation supprimée avec succès');
    }
    
    /*
    public function showEditFormaion($ID_FORMATION){
        return view('editFormation', [
            'formation' => $ID_FORMATION,

            'initsLess' => DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->whereNotIn('initiators.id_per',function ($query){
                $query->select('id_per')->from('training_managers');
            })->get(),

            'inits' => DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->whereNotIn('initiators.id_per',function ($query){
                $query->select('id_per_initiator')->from('trains');
            })->get(),

            'studs' => DB::table('students')->join('persons','students.id_per','=','persons.id_per')->get(),
        ]);
    }
    
    public function editFormation(Request $request, $ID_FORMATION){
        //Validation des données
        $validData = $request->validate([
            'id_per_training_manager' => 'integer',
            'id_level' => 'integer',
            'date_beginning' => 'date',
            'date_ending' => 'date',
        ]);

        $other = Persons::where('name', $request->name)->first();

        $person = Initiator::where('id_per',$other->ID_PER)->first();

        DB::table('formations')->where('ID_FORMATION', $ID_FORMATION)
            ->update(['id_per_training_manager' => $person->ID_PER,'id_level' => $validData['id_level'],
                    'date_beginning' => $validData['date_beginning'],'date_ending' => $validData['date_ending']]);
        DB::table('trains')->where('id_formation',$ID_FORMATION)
            ->update(['id_per_initiator' => $person->])
            
        return redirect()->back()->with('success', 'Formation modifiée avec succès');
    }*/

}
