<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class CalendarController extends BaseController
{
    public function calendarDirector (): View 
    {
        return view('Calendar.calendarFormateur');
    }

    public function calendarStudents (): View 
    {
        return view('Calendar.calendarStudent');
    }

    public function calendarInitiator (): View 
    {
        return view('Calendar.calendarInitiator');
    }

    

    public function BaseCalendar (): View 
    {
        return view('BaseCalendar');
    }

    public function AddDate(string $newdate)
    {
        return view('Calendar.testdays', [
            'newdate' => $newdate
        ]);
    }

}
