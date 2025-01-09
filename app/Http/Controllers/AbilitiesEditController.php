<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbilitiesEditController extends Controller
{
    public function index(string $level){
        $skills = DB::table('skills')
        ->where('id_level',$level)
        ->get();

        $abilities = DB::table('abilities')
        ->join('skills','abilities.id_skills', '=', 'skills.id_skills')
        ->where('id_level',$level)
        ->get();

        return view('?', [
            'skills' => $skills,
            'abilities' => $abilities,
        ]);
        
    }
}
