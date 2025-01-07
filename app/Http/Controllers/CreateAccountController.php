<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Initiator;
use App\Models\Trainingmanager;
use App\Models\Persons;

class CreateAccountController extends Controller
{
    public function choiceUser(Request $request){
        echo "dedzed";
        $request->validate([
                  'name' => 'required|string|max:255',
                  'surname' => 'required|string|max:255',
                  'mail_adress' => 'required|email|unique:users,email',
                  'password' => 'required|min:6|confirmed',
                  'licence_number' => 'required|string',
                  'medical_certificate_date' => 'required|date',
                  'birth_date' => 'required|date',
                  'adress' => 'required|string',
                  'Initiator' => 'nullable|boolean',
                  'Trainigmanager' => 'nullable|boolean',
                  'Student' => 'nullable|boolean',
              ]);
      
              $user = new Persons();
              $user->id = 1;
              $user->name = $request->name;
              $user->surname = $request->surname;
              $user->mail_adress = $request->mail_adress;
              $user->password = bcrypt($request->password);  
              $user->licence_number = $request->licence_number;
              $user->medical_certificate_date = $request->medical_certificate_date;
              $user->birth_date = $request->birth_date;
              $user->adress = $request->adress;
      
      
              $roles = $request->input('roles');
                  
              if (in_array('Initiator', $roles)) {
                  $initiator = new Initiator();
                  $initiator->user_id = $user->id;
                  $initiator->save();
              }
      
              if (in_array('Trainingmanager', $roles)) {
                  $trainingmanager = new Trainingmanager();
                  $trainingmanager->user_id = $user->id;
                  $trainingmanager->save();
              }
      
              if (in_array('Student', $roles)) {
                  $student = new Student();
                  $student->user_id = $user->id;
                  $student->save();
              }
      

      
        $message = "Personne enregistrer dans la base de donnée";
        return view('form_account', compact('message'));
      
      }
}
