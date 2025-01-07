<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;

class CreateFormController extends Controller
{

    public function create(){
        return view('creationFormation');
    }

}
