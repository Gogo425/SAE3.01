<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Initiators;
use App\Models\Persons;
use App\Http\Controllers\DB;

class ManageController extends Controller
{
    public function index()
    {
        
        $students = DB::table('students')->get();
        $initiators = DB::table('initiators')->get();
        $persons = DB::table('persons')->get();


        
    
    return view('manage', ['students' => $students,  'initiators' => $initiators, 'persons' => $persons]);

    }
    
}
