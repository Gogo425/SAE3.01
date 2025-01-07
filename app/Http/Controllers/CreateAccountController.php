<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Initiator;
use App\Models\Trainingmanager;
use App\Models\Persons;

class CreateAccountController extends Controller
{
    public function choiceUser(Request $request)
    {

        dd($request->all());
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'mail_adress' => 'required|email|unique:persons,mail_adress',
            'password' => 'required|min:6|confirmed',
            'licence_number' => 'required|string',
            'medical_certificate_date' => 'required|date',
            'birth_date' => 'required|date',
            'adress' => 'required|string',
        ]);
    
        Persons::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'mail_adress' => $validatedData['mail_adress'],
            'password' => bcrypt($validatedData['password']), 
            'licence_number' => $validatedData['licence_number'],
            'medical_certificate_date' => $validatedData['medical_certificate_date'],
            'birth_date' => $validatedData['birth_date'],
            'adress' => $validatedData['adress'],
        ]);

       

        // Redirection avec message
        return redirect()->route('form_account')->with('message', 'Personne enregistrée dans la base de données');
    }
}
