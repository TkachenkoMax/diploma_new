<?php

namespace App\Http\Controllers;


/**
 * Class ErrorController
 * @package App\Http\Controllers
 */
class ErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('errors.error');
    }
}