<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableStudentController extends Controller
{
    function TableStudentPage(){
        
        return view('tableStudent');
    }
}
