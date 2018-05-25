<?php

namespace App\Http\Controllers;

use App\Repositories\CalendarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

    /**
     * @var \App\Repositories\CalendarRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\CalendarRepository $repository
     */
    public function __construct(CalendarRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the calendars management page.
     *
     * @return \Illuminate\Http\Response
     */
    public function management()
    {
        $users = Auth::user()->getContacts()->pluck('fullName', 'id')->toArray();

        return view('dashboard.management')->with(['users' => $users]);
    }

    /**
     * Create new calendar and assign users to it.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $result = $this->repository->createCalendar($data);

        if ($result) {
            return response('Calendar created successfully');
        }

        return response('Something went wrong', 500);
    }
}
