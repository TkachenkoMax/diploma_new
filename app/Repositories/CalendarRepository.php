<?php

namespace App\Repositories;

use App\Models\Calendar;

/**
 * Class CalendarRepository.
 * @package namespace App\Repositories;
 */
class CalendarRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Calendar::class;
    }

    /**
     * Find calendar by ID.
     *
     * @param integer $id calendar id
     *
     * @return \App\Models\Calendar
     */
    public function findById($id)
    {
        return $this->find($id);
    }
}