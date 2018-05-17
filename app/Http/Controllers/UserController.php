<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $user = Auth::user();

        return view('settings.index')->with('user', $user);
    }

    /**
     * Change user password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password'     => 'required|string|min:6',
        ]);

        $params = $request->all();
        $this->repository->changePassword($params);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    /**
     * Change user account information.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeInformation(Request $request)
    {
        $params = $request->except('_token');
        $this->repository->changeInformation($params);

        return redirect()->back()->with('success', 'Information changed successfully!');
    }
}
