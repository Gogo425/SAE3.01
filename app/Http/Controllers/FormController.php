<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Persons;
use App\Models\Trains;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{

    public function create(){
        /*
        $test = DB::table('initiators')->get();
        dd($test);*/
        
        // $test = DB::table('initiators')->join('trains','initiators.id_per','=','trains.id_per_initiator')->join('persons','initiators.id_per','=','persons.id_per')->get();
        // dd($test);
        

        return view('formation', [
            'forms' => DB::table('formations')->get(),
            'inits' => DB::table('initiators')->join('trains','initiators.id_per','=','trains.id_per_initiator')->join('persons','initiators.id_per','=','persons.id_per')->get(),
            'pers' => DB::table('persons')->get(),
            'studs' => DB::table('students')->join('persons','students.id_per','=','persons.id_per')->get()
        ]);
    }
    /*
    public function delete(string $id){
        DB::table('formations')->where('ID_FORMATION','=',$id)->delete();
        return view('formation', [
            'forms' => DB::table('formations')->get()
        ]);
    }*/

}
