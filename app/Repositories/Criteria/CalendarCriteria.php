<?php

namespace App\Repositories\Criteria;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CalendarCriteria.
 */
class CalendarCriteria extends BaseCriteria
{
    /**
     * Apply criteria in query repository.
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

        return $model;
    }
}