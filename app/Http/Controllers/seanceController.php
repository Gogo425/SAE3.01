<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;

class seanceController extends Controller
{

    public function creation()
    {
        /*\App\Models\Student::all();

        $session = DB::table('sessions')->get();
        dd($session);*/

        return view('creationSeance', ['listEleve' => ['lucas', 'clemence'], 'listAptitude' => ['A11', 'A12', 'C11'], 'listInitiateur' => ['Fabrice', 'Leopold', 'Felix']]);
    }

    public function save(Request $request) {


        $validated = $request->validate([
            //'id_locate' => 'required | integer'
            'id_initiate' => 'required | integer',
            'date_session' => 'required | date'
        ]);

        
        dd($request->all());

    }

}