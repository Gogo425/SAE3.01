<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Initiators;
use App\Models\Persons;

class ManageController extends Controller
{
    public function index()
    {
        
        $students = Students::all();
        $initiators = Initiators::all();
        $persons = Persons::all();
        
    
        return view('manage', compact('students'));
    }
}
