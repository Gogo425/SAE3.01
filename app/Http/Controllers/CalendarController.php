<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class CalendarController extends BaseController
{
    public function calendar (): View {
        return view('Calendar.calendarStudent');
    }
}
