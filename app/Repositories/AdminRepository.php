<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Criteria\UserCriteria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

/**
 * Class AdminRepository
 * @package namespace App\Repositories;
 */
class AdminRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Find user by ID
     *
     * @param integer $id user id
     *
     * @return \App\Models\User
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * Get users list for DataTable.
     *
     * @return \Illuminate\Http\JsonResponse;
     * @throws \Exception
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getUsersList(): JsonResponse
    {
        $builder = $this->pushCriteria(app(UserCriteria::class))
            ->with(['roles'])
            ->getBuilder()
            ->select('users.*');

        return DataTables::of($builder)->make(true);
    }

    /**
     * Edit user features.
     *
     * @param array $roles
     * @param User $user
     *
     * @return \App\Models\User
     */
    public function updateRoles(array $roles, User $user)
    {
        $roles = $this->syncRelationRoles($user, $roles);

        return $roles
            ? response()->json([
                'message' => 'User roles were successfully saved.',
                'type'    => 'success'
            ])
            : response()->json([
                'message' => 'Saving roles failed. Please try again.',
                'type'    => 'error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Permanently delete a user by id.
     *
     * @param $id
     * @return int
     */
    public function deleteUser($id)
    {
        return User::destroy($id);
    }

    /**
     * Relation roles.
     *
     * @param \App\Models\User $user
     * @param array $attributes
     *
     * @return array
     */
    private function syncRelationRoles($user, $attributes)
    {
        return $user->syncRoles($attributes);
    }
}
