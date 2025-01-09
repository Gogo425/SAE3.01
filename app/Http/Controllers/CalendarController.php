<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class CalendarController extends BaseController
{
    public function calendarDirector (): View 
    {
        $sessions = DB::table('sessions')->get('date_session');
        //dd($sessions);
        return view('Calendar.calendarFormateur', [
            'sessions' => $sessions
        ]);
    }

    public function calendarStudents (): View 
    {
        $sessions = DB::table('sessions')->get('date_session');
        return view('Calendar.calendarStudent', [
            'sessions' => $sessions
        ]);
    }

    public function calendarInitiator (): View 
    {
        $sessions = DB::table('sessions')->get('date_session');
        return view('Calendar.calendarInitiator', [
            'sessions' => $sessions
        ]);
    }

    

    public function BaseCalendar (): View 
    {
        return view('BaseCalendar');
    }

}
