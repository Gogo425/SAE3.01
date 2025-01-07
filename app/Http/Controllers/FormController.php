<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Persons;

class FormController extends Controller
{

    public function create(){
        return view('formation');
    }

    public function showForm (){
        $form = Formation::all();
        redirect('formation');
    }

}
