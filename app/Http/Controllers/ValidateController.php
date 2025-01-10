<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateController extends Controller
{
    public function levelUp(Request $request){
        
        $idStudent =$request->student_id;
        $levelStudent = DB::table('students')->where('ID_PER', $request->student_id)->select('id_level')->get()[0]->id_level;
        $certificatDate = new DateTime(DB::table('persons')->where('ID_PER',$idStudent)->select('MEDICAL_CERTIFICATE_DATE')->get()[0]->MEDICAL_CERTIFICATE_DATE);
        $bornDate = new DateTime(DB::table('persons')->where('ID_PER',$idStudent)->select('BIRTH_DATE')->get()[0]->BIRTH_DATE);
        $dateDay = new DateTime();
        $currentYear = date('Y');
        $endOfAugust = new \DateTime("$currentYear-08-31");
        $interval = $certificatDate->diff($endOfAugust);
        $good = false;
        if ($interval->y < 1) {
            $good = true;
        } else {
            $good = false;
        }
        $age = $bornDate->diff($dateDay)->y;
        


        if($levelStudent === 1 || $levelStudent === 2){
            
            if($age >= 14 && $good){
                DB::table('students')->where('ID_PER', $idStudent)
                ->update(['id_level' => $levelStudent+1]);
                return redirect()->route('tableStudent')->with('popup', 'L\'étudiant a bien changé de niveau.');
            }else{
                return redirect()->route('tableStudent')->with('popup', 'La personne n\'a pas encore 14 ans ou le certificat n\'est pas valide.');
            }
        }else{
            if($age >= 18 && $good){
                DB::table('students')->where('ID_PER', $idStudent)
                ->update(['id_level' => $levelStudent+1]);
                return redirect()->route('tableStudent')->with('popup', 'L\'étudiant a bien changé de niveau.');
            }else{
                return redirect()->route('tableStudent')->with('popup', 'La personne n\'a pas encore 18 ans ou le certificat n\'est pas valide.');
                
            }
        }
        

        return redirect()->route('tableStudent');
        
    }
}
