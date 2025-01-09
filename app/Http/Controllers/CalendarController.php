<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class CalendarController extends BaseController
{
    /**
     * Display the calendar for directors.
     * 
     * @return View
     */
    public function calendarDirector(): View
    {
        // Retrieve all sessions from the database
        $sessions = DB::table('sessions')->get();

        // Pass the sessions data to the director's calendar view
        return view('Calendar.calendarFormateur', [
            'sessions' => $sessions
        ]);
    }

    /**
     * Display the calendar for students.
     * 
     * @return View
     */
    public function calendarStudents(): View
    {
        // Retrieve distinct session IDs and dates for the currently authenticated student
        $sessions = DB::table('sessions')
            ->select(DB::raw('distinct sessions.id_sessions, date_session'))
            ->join('works', 'works.id_sessions', '=', 'sessions.id_sessions')
            ->join('students', 'students.id_per', '=', 'works.id_per_student')
            ->where('works.id_per_student', Auth::id()) // Filter sessions for the logged-in student
            ->get();

        // Pass the sessions data to the student's calendar view
        return view('Calendar.calendarStudent', [
            'sessions' => $sessions
        ]);
    }

    /**
     * Display the calendar for initiators.
     * 
     * @return View
     */
    public function calendarInitiator(): View
    {
        // Retrieve distinct session IDs and dates for the currently authenticated initiator
        $sessions = DB::table('sessions')
            ->select(DB::raw('distinct sessions.id_sessions, date_session'))
            ->join('works', 'works.id_sessions', '=', 'sessions.id_sessions')
            ->join('initiators', 'initiators.id_per', '=', 'works.id_per_initiator')
            ->where('works.id_per_initiator', Auth::id()) // Filter sessions for the logged-in initiator
            ->get();

        // Pass the sessions data to the initiator's calendar view
        return view('Calendar.calendarInitiator', [
            'sessions' => $sessions
        ]);
    }

    /**
     * Display the base calendar.
     * 
     * @return View
     */
    public function BaseCalendar(): View
    {
        // Return the base calendar view (no session-specific data)
        return view('BaseCalendar');
    }
}
