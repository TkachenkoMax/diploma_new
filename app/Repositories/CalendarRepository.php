<?php

namespace App\Repositories;

use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Store new calendar in the database.
     *
     * @param array $data
     * @return bool
     */
    public function createCalendar(array $data): bool
    {
        $calendar = new $this->model();
        $calendar->fill(array_only($data, ['name', 'description', 'is_public', 'is_editable']) + ['creator_id' => Auth::user()->id]);
        $calendar->save();

        $calendar->users()->attach($data['assigned_users'] ?? []);

        return true;
    }
}