<?php

namespace App\Http\Controllers;

class CalendarController extends Controller
{
    /**
     * Show the calendars management page.
     *
     * @return \Illuminate\Http\Response
     */
    public function management()
    {
        return view('dashboard.management');
    }
}
