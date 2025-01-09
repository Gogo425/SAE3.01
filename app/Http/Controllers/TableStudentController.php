<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Evaluations;

class TableStudentController extends Controller
{
    function TableStudentPage(){
        
        return view('tableStudent');
    }
    public function validerEtudiant($id)
{
    echo "$id";

    // Rediriger vers la page de l'étudiant après l'opération
    return view('tableStudent');
}
}
