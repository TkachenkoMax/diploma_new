<?php

namespace App\Models;

use Ultraware\Roles\Models\Role as BaseRole;

class Role extends BaseRole
{
    const ADMINISTRATOR_SLUG = 'admin';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'level',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'description', 'level', 'pivot', 'created_at', 'updated_at'
    ];
}