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

            'inits' => DB::table('initiators')->join('persons','initiators.id_per','=','persons.id_per')->whereNotIn('initiators.id_per',function ($query){
                $query->select('id_per_initiator')->from('trains');
            })->get(),

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
        $formation->id_level = $request->id_level+1;
        $formation->date_beginning = $request->date_beginning;
        $formation->date_ending = $request->date_ending;
        $formation->save();

        $maxForma = DB::table('formations')->orderBy('id_formation','DESC')->get();

        foreach($request->inits as $init){
            $trains = new Trains();
            $trains->id_per_initiator = $init;
            $trains->id_formation = $maxForma->first()->ID_FORMATION;
            $trains->save();
        }

        foreach($request->studs as $stud){
            DB::table('students')->where('id_per','=',$stud)->update(['id_formation'=> $maxForma->first()->ID_FORMATION]);
        }

        return redirect()->back()->with('success', 'Formation ajoutée avec succès');
    }



    public function deleteFormation($ID_FORMATION){
        DB::table('students')->where('id_formation',$ID_FORMATION)->update(['id_formation' => 1]);
        DB::table('trains')->where('id_formation',$ID_FORMATION)->delete();
        $id = DB::table('formations')->where('id_formation',$ID_FORMATION)->get();
        DB::table('formations')->where('id_formation',$ID_FORMATION)->delete();
        DB::table('training_managers')->where('id_per',$id->ID_PER_TRAINING_MANAGER)->delete();
        return redirect()->back()->with('success', 'Formation supprimée avec succès');
    }

}
