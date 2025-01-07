<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Initiators;
use App\Models\Persons;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CreateAccountController extends Controller
{
    public function choiceUser(Request $request)
    {
        Log::info('Début du traitement du formulaire.');

        // Valider les données
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'mail_adress' => 'required|email|unique:persons,mail_adress',
            'password' => 'required|min:6|confirmed',
            'licence_number' => 'required|string',
            'medical_certificate_date' => 'required|date',
            'birth_date' => 'required|date',
            'adress' => 'required|string',
            // 'roles' => 'required|array',
        ]);

        Log::info('Validation passée avec succès.');

        // Créer une nouvelle personne
        $person = Persons::create([
            'id' => Persons::count() +1,
            'name' => $request->name,
            'surname' => $request->surname,
            'mail_adress' => $request->mail_adress,
            'password' => Hash::make($request->password),
            'licence_number' => $request->licence_number,
            'medical_certificate_date' => $request->medical_certificate_date,
            'birth_date' => $request->birth_date,
            'adress' => $request->adress,
        ]);
        Log::info('Personne créée avec succès : ');

        // Gérer les rôles
        $lvl = 0;
        foreach($request->level as $lvle){
            if($lvle === 'ni1'){
                $lvl = 1;
            }
            if($lvle === 'ni2'){
                $lvl = 2;
            }
            if($lvle === 'ni3'){
                $lvl = 3;
            }
        }


        foreach($request->roles as $role){
            if ($role === 'Initiator') {
                Initiators::create(['id_usertype' => Persons::count(), 'id' => $lvl]);
            }

            else if ($role === 'Student') {
                Students::create(['id_usertype' => Persons::count() , 'id' => $lvl , 'id_learn' => $lvl+1]);
            }
        }
           
        

        Log::info('Fin du traitement du formulaire.');

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Utilisateur enregistré avec succès !');
    }
}