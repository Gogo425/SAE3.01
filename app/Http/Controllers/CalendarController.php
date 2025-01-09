<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class CalendarController extends BaseController
{
    public function calendarDirector (): View 
    {
        $sessions = DB::table('sessions')->get();
        return view('Calendar.calendarFormateur', [
            'sessions' => $sessions
        ]);
    }

    public function calendarStudents (): View 
    {
        $sessions = DB::table('sessions')
        ->select(DB::raw('distinct sessions.id_sessions, date_session'))
        ->join('works', 'works.id_sessions', '=', 'sessions.id_sessions')
        ->join('students', 'students.id_per', '=', 'works.id_per_student')
        ->get();
        return view('Calendar.calendarStudent', [
            'sessions' => $sessions
        ]);
    }

    public function calendarInitiator (): View 
    {
        $sessions = DB::table('sessions')
        ->select(DB::raw('distinct sessions.id_sessions, date_session'))
        ->join('works', 'works.id_sessions', '=', 'sessions.id_sessions')
        ->join('initiators', 'initiators.id_per', '=', 'works.id_per_initiator')
        ->get();
        return view('Calendar.calendarInitiator', [
            'sessions' => $sessions
        ]);
    }

    

    public function BaseCalendar (): View 
    {
        return view('BaseCalendar');
    }

}
