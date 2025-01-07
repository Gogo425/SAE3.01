<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;
use App\Models\initiators;
use App\Models\trainingmanagers;
use App\Models\persons;
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
        $person = persons::create([
            'id' => persons::count() + 1,
            'name' => $request->name,
            'surname' => $request->surname,
            'mail_adress' => $request->mail_adress,
            'password' => Hash::make($request->password),
            'licence_number' => $request->licence_number,
            'medical_certificate_date' => $request->medical_certificate_date,
            'birth_date' => $request->birth_date,
            'adress' => $request->adress,
        ]);
        Log::info('Personne créée avec succès : ' . $person->id);

        // Gérer les rôles
        foreach ($request->roles as $role) {
            if ($role === 'Initiator') {
                initiators::create(['id_usertype' => persons::count(), 'id'=>initiators::count()+1]);
            }

            else if ($role === 'Trainingmanager') {
                trainingmanagers::create(['id_usertype' => persons::count()]);
            }

            else if ($role === 'Student') {
                students::create(['id_usertype' => persons::count() , 'id'=>initiators::count()+1 ,'id_learn' => 1]);
            }
        }

        Log::info('Fin du traitement du formulaire.');

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Utilisateur enregistré avec succès !');
    }
}