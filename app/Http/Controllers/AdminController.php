<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @var \App\Repositories\AdminRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\AdminRepository $repository
     */
    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['roles'] = Role::all()->pluck('name', 'id')->toArray();

        return view('admin.usersList')->with('data', $data);
    }

    /**
     * Process data tables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getUsers(): JsonResponse
    {
        return $this->repository->getUsersList();
    }

    /**
     * Return user profile view.
     *
     * @param $id
     * @return $this
     */
    public function viewUser($id)
    {
        $user = User::with(['roles'])->where('id', $id)->first();
        $roles = Role::all()->pluck('name', 'id')->toArray();

        return view('admin.modals.userView')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update user's roles.
     *
     * @param Request $request
     * @param $id
     * @return User
     */
    public function updateRoles(Request $request, $id)
    {
        $user  = User::findOrFail($id);
        $roles = collect(is_array($request->roles) ?: [$request->roles])->filter(function ($role) {
            return $role > 0;
        })->toArray();

        return $this->repository->updateRoles($roles, $user);
    }

    /**
     * Delete a user form the database.
     *
     * @param $id
     * @return int
     */
    public function deleteUser($id)
    {
        return $this->repository->deleteUser($id);
    }
}
