<?php

namespace App\Repositories\Criteria;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UserCriteria
 */
class UserCriteria extends BaseCriteria
{
    /**
     * Apply criteria in query repository
     *
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return RepositoryInterface $model
     * @throws \Exception
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = parent::apply($model, $repository);

        $model = $this->filterByName($model);
        $model = $this->filterByRole($model);

        return $model;
    }

    /**
     * Filter by name.
     *
     * @param $model
     * @return mixed
     */
    private function filterByName($model)
    {
        if ($this->request->has('name') && $this->request->get('name') != '') {
            $model = $model->where(function ($query) {
                $query->whereRaw('concat(firstname, \' \', lastname) like \'%' . $this->request->name . '%\' ');
            });
        }

        return $model;
    }

    /**
     * Filter by role.
     *
     * @param $model
     * @return mixed
     */
    private function filterByRole($model)
    {
        if ($this->request->has('user_role') && $this->request->get('user_role') != 'all') {
            $usersIds = DB::table('role_user')->where('role_id', '=', $this->request->user_role)->get();

            $model = $model->where(function ($query) use ($usersIds) {
                $query->whereIn('id', $usersIds->pluck('user_id')->toArray());
            });
        }

        return $model;
    }
}