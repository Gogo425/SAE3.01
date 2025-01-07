<?php

namespace App\Http\Controllers;
use App\Models\skills;
use Illuminate\Http\Request;

class TableAbilitiesController extends Controller
{
    function TableAbilitiesPage(){
        return view('tableAbilities');
    }
    

}
