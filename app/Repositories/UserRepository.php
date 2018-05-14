<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Criteria\UserCriteria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

/**
 * Class UserRepository.
 * @package namespace App\Repositories;
 */
class UserRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Find user by ID.
     *
     * @param integer $id user id
     *
     * @return \App\Models\User
     */
    public function findById($id)
    {
        return $this->find($id);
    }
}