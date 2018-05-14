<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository as VendorRepository;
use Prettus\Repository\Traits\CacheableRepository;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BaseRepository
 * @package namespace App\Repositories;
 */
abstract class BaseRepository extends VendorRepository implements CacheableInterface
{
    use CacheableRepository;

    /**
     * Get query builder
     *
     * @return mixed
     */
    public function getBuilder()
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($this->model instanceof Builder) {
            return $this->model;
        } else {
            return $this->model->newQuery();
        }
    }

}
