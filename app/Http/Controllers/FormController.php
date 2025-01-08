<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Persons;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{

    public function create(){
        
        return view('formation', [
            'forms' => DB::table('formations')->get()
        ]);
    }

    public function delete($value){
        DB::table('formations')->where('ID_FORMATION','=',$value)->delete();
    }

}
