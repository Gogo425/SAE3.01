<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Initiators;
use App\Models\Persons;
use App\Models\User;
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
            'email' => 'required|email|unique:persons,email',
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
            'id_per' => Persons::count() +1,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'licence_number' => $request->licence_number,
            'medical_certificate_date' => $request->medical_certificate_date,
            'birth_date' => $request->birth_date,
            'adress' => $request->adress,
        ]);
        Log::info('Personne créée avec succès : ');

        $user = User::create([
            'id' => $person->id_per,
            'name' => $person->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Gérer les rôles
        $lvl = 1;
        foreach($request->level as $lvle){
            if($lvle === 'ni1'){
                $lvl = 2;
            }
            if($lvle === 'ni2'){
                $lvl = 3;
            }
            if($lvle === 'ni3'){
                $lvl = 4;
            }
        }


        foreach($request->roles as $role){
            if ($role === 'Initiator') {
                Initiators::create(['id_per' => Persons::count(), 'id_level' => $lvl]);
            }

            else if ($role === 'Student') {
                Students::create(['id_per' => Persons::count() , 'id_level' => $lvl , 'id_formation' => 2]);
            }
        }
           
        

        Log::info('Fin du traitement du formulaire.');

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Utilisateur enregistré avec succès !');
    }
}