<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateController extends Controller
{
    public function levelUp(Request $request){
        
        
        $level = DB::table('students')->where('ID_PER', $request->student_id)->select('id_level')->get()[0]->id_level+1;
        

        DB::table('students')->where('ID_PER', $request->student_id)
        ->update(['id_level' => $level]);


        return redirect()->route('tableStudent');
    }
}
