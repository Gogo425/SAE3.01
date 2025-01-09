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
    /**
     * Handles the creation of a new user account based on their selected roles.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function choiceUser(Request $request)
    {
        // Log the beginning of form processing
        Log::info('Début du traitement du formulaire.');

        // Custom error messages for validation
        $messages = [
            'licence_number.regex' => 'Le numéro de licence doit suivre le format A-XX-XXXXXX (ex: A-03-253653).',
        ];

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255', // Name is required, must be a string, and max length is 255
            'surname' => 'required|string|max:255', // Surname is required, must be a string, and max length is 255
            'email' => 'required|email|unique:persons,email', // Email is required, must be unique in the 'persons' table
            'password' => 'required|min:6|confirmed', // Password is required, min length is 6, must match confirmation
            'licence_number' => [
                'required',
                'regex:/^[A-Z]-\d{2}-\d{6}$/', // Licence number must match the specified pattern
            ],
            'medical_certificate_date' => 'required|date', // Medical certificate date is required and must be a valid date
            'birth_date' => 'required|date', // Birth date is required and must be a valid date
            'adress' => 'required|string', // Address is required and must be a string
        ], $messages);

        // Log successful validation
        Log::info('Validation passée avec succès.');

        // Create a new Person entry in the database
        $person = Persons::create([
            'id_per' => Persons::count() + 1, // Generate a new ID based on the count of existing persons
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password for security
            'licence_number' => $request->licence_number,
            'medical_certificate_date' => $request->medical_certificate_date,
            'birth_date' => $request->birth_date,
            'adress' => $request->adress,
        ]);

        // Log successful person creation
        Log::info('Personne créée avec succès : ');

        // Create a corresponding User entry for authentication
        $user = User::create([
            'id' => $person->id_per, // Use the same ID as the person
            'name' => $person->name,
            'email' => $person->email,
            'password' => $person->password, // Use the hashed password from the person record
        ]);

        // Determine the level based on the request's level input
        $lvl = 1; // Default level
        foreach ($request->level as $lvle) {
            if ($lvle === 'ni1') {
                $lvl = 2;
            }
            if ($lvle === 'ni2') {
                $lvl = 3;
            }
            if ($lvle === 'ni3') {
                $lvl = 4;
            }
            if ($lvle === 'mf1') {
                $lvl = 5;
            }
            if ($lvle === 'mf2') {
                $lvl = 6;
            }
        }

        // Handle the roles assigned to the user
        foreach ($request->roles as $role) {
            if ($role === 'Initiator') {
                // Create an Initiator entry if the user is an initiator
                Initiators::create([
                    'id_per' => Persons::count(), // Use the same ID as the person
                    'id_level' => $lvl, // Assign the determined level
                ]);
            } elseif ($role === 'Student') {
                // Create a Student entry if the user is a student
                Students::create([
                    'id_per' => Persons::count(), // Use the same ID as the person
                    'id_level' => $lvl, // Assign the determined level
                    'id_formation' => 1, // Assign a default formation ID
                ]);
            }
        }

        // Log the end of form processing
        Log::info('Fin du traitement du formulaire.');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Utilisateur enregistré avec succès !');
    }
}
